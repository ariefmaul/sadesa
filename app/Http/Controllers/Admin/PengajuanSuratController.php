<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\PengajuanSurat;
use App\Notifications\PengajuanDisetujuiNotification;
use App\Notifications\PengajuanDitolakNotification;
use App\Services\QrCodeService;
use App\Services\TemplateSuratService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PengajuanSuratController extends Controller
{
    public function index(Request $request): View
    {
        $admin = $request->user();

        $pengajuans = PengajuanSurat::query()
            ->with([
                'user.desa',
                'jenisSurat',
                'dokumen',
            ])
            ->whereHas(
                'user',
                fn ($query) => $query->where(
                    'desa_id',
                    $admin->desa_id
                )
            )
            ->latest()
            ->paginate(10);

        return view(
            'admin.pengajuan.index',
            compact('pengajuans')
        );
    }

    public function show(
        Request $request,
        PengajuanSurat $pengajuan
    ): View {

        $this->authorize('view', $pengajuan);

        $pengajuan->load([
            'user.desa',
            'jenisSurat',
            'dokumen',
        ]);

        return view(
            'admin.pengajuan.show',
            compact('pengajuan')
        );
    }

    public function approve(
        Request $request,
        PengajuanSurat $pengajuan,
        TemplateSuratService $templateService,
        QrCodeService $qrCodeService
    ): RedirectResponse {

        $this->authorize('approve', $pengajuan);

        if ($pengajuan->status === 'disetujui') {
            return redirect()
                ->route(
                    'admin.pengajuan.show',
                    $pengajuan
                )
                ->with(
                    'error',
                    'Pengajuan ini sudah disetujui.'
                );
        }

        $validated = $request->validate([
            'nomor_surat' => ['required', 'string', 'max:255', 'unique:dokumens,nomor_surat'],
        ], [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'nomor_surat.unique' => 'Nomor surat sudah digunakan.',
        ]);

        try {
            $dok = DB::transaction(function () use ($request, $pengajuan, $templateService, $qrCodeService, $validated) {

                $nomorDokumen = 'DOC-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));

                $existing = $pengajuan->dokumen;

                if ($existing) {

                    throw new \RuntimeException('Dokumen untuk pengajuan ini sudah ada.');
                }

                $file = $templateService->generateDocx($pengajuan, [

                    'nomor_surat' => trim($validated['nomor_surat']),
                    'tanggal_surat' => now()->translatedFormat('d F Y'),
                ]);

                $pdfPath = null;
                try {
                    $pdfPath = $templateService->convertDocxToPdf($file);
                } catch (\Throwable $e) {

                    try {
                        Storage::disk('public')->delete($file);
                    } catch (\Throwable $_) {
                    }
                    throw $e;
                }

                $qrToken = (string) Str::uuid();
                $qrFile = $qrCodeService->generate($qrToken);

                $dok = Dokumen::create([
                    'pengajuan_surat_id' => $pengajuan->id,
                    'nomor_dokumen' => $nomorDokumen,
                    'nomor_surat' => trim($validated['nomor_surat']),
                    'file' => $file,
                    'dokumen_pdf' => $pdfPath,
                    'qr_token' => $qrToken,
                    'qr_file' => $qrFile,
                    'status' => 'tersedia',
                ]);

                $pengajuan->update([
                    'status' => 'disetujui',
                    'verified_at' => now(),
                    'verified_by' => $request->user()->id,
                ]);

                $pengajuan->loadMissing(['user.desa.kecamatan.kota.provinsi', 'jenisSurat']);
                $pengajuan->user->notify(new PengajuanDisetujuiNotification($pengajuan));

                return $dok;
            });
        } catch (\Throwable $e) {

            Log::error('SADESA APPROVE FAILED', [
                'pengajuan_id' => $pengajuan->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('admin.pengajuan.show', $pengajuan)
                ->with('error', 'Gagal membuat dokumen: '.$e->getMessage());
        }

        return redirect()
            ->route('admin.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil disetujui. Dokumen Word, PDF, dan QR Code berhasil dibuat.');
    }

    public function realtime(Request $request)
    {
        $admin = $request->user();

        $latestPending = PengajuanSurat::query()
            ->with(['user.desa', 'jenisSurat'])
            ->whereHas('user', fn ($query) => $query->where('desa_id', $admin->desa_id))
            ->whereIn('status', ['menunggu'])
            ->latest('created_at')
            ->first();

        return response()->json([
            'count' => PengajuanSurat::query()
                ->whereHas('user', fn ($query) => $query->where('desa_id', $admin->desa_id))
                ->whereIn('status', ['menunggu'])
                ->count(),
            'latest' => $latestPending ? [
                'id' => $latestPending->id,
                'nomor_pengajuan' => $latestPending->nomor_pengajuan,
                'nama' => $latestPending->user?->name,
                'jenis_surat' => $latestPending->jenisSurat?->nama,
                'created_at' => $latestPending->created_at?->toDateTimeString(),
            ] : null,
        ]);
    }

    public function notifications(Request $request)
    {
        $admin = $request->user();

        $allowedTypes = [
            'App\\Notifications\\PengajuanBaruNotification',
            'App\\Notifications\\MasyarakatBaruNotification',
        ];

        $notifications = $admin->notifications()
            ->whereIn('type', $allowedTypes)
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($notification) {
                $data = $notification->data;

                return [
                    'id' => $notification->id,
                    'type' => $data['type'] ?? ($data['pengajuan_id'] ? 'pengajuan_baru' : 'masyarakat_baru'),
                    'title' => $data['title'] ?? 'Notifikasi baru',
                    'message' => $data['message'] ?? 'Ada notifikasi baru',
                    'route' => $data['route'] ?? route('admin.pengajuan.index'),
                    'pengajuan_id' => $data['pengajuan_id'] ?? null,
                    'user_id' => $data['user_id'] ?? null,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at?->diffForHumans(),
                ];
            });

        $unreadCount = $admin->unreadNotifications()
            ->whereIn('type', $allowedTypes)
            ->count();

        return response()->json([
            'count' => $unreadCount,
            'items' => $notifications,
        ]);
    }

    public function markNotificationAsRead(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }

    public function reject(
        Request $request,
        PengajuanSurat $pengajuan
    ): RedirectResponse {

        $this->authorize('reject', $pengajuan);

        $validated = $request->validate([
            'catatan' => [
                'nullable',
                'string',
            ],
        ]);

        $pengajuan->update([
            'status' => 'ditolak',
            'catatan' => $validated['catatan'] ?? null,
            'verified_at' => now(),
            'verified_by' => $request->user()->id,
        ]);

        $pengajuan->loadMissing(['user.desa.kecamatan.kota.provinsi', 'jenisSurat']);
        $pengajuan->user->notify(new PengajuanDitolakNotification($pengajuan, $validated['catatan'] ?? null));

        return redirect()
            ->route(
                'admin.pengajuan.show',
                $pengajuan
            )
            ->with(
                'success',
                'Pengajuan berhasil ditolak.'
            );
    }

    public function downloadWord(Request $request, Dokumen $dokumen)
    {

        $this->authorize('view', $dokumen->pengajuanSurat);

        if (! $dokumen->file || ! Storage::disk('public')->exists($dokumen->file)) {
            abort(404);
        }

        $stream = Storage::disk('public')->readStream($dokumen->file);
        if (! $stream) {
            abort(404);
        }

        $filename = basename($dokumen->file);

        return response()->streamDownload(function () use ($stream) {
            fpassthru($stream);
        }, $filename);
    }

    public function downloadPdf(Request $request, Dokumen $dokumen)
    {
        $this->authorize('view', $dokumen->pengajuanSurat);

        if (! $dokumen->dokumen_pdf || ! Storage::disk('public')->exists($dokumen->dokumen_pdf)) {
            abort(404);
        }

        $stream = Storage::disk('public')->readStream($dokumen->dokumen_pdf);
        if (! $stream) {
            abort(404);
        }

        $filename = basename($dokumen->dokumen_pdf);

        return response()->streamDownload(function () use ($stream) {
            fpassthru($stream);
        }, $filename);
    }
}
