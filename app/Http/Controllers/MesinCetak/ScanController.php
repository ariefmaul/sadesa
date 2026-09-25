<?php

namespace App\Http\Controllers\MesinCetak;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Services\QrCodeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ScanController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'role:mesin,mesin_cetak']);
    }

    public function index(): View
    {
        return view('mesin.scan');
    }

    public function verify(Request $request, string $token): View
    {
        $dokumen = Dokumen::with(['pengajuanSurat.jenisSurat', 'pengajuanSurat.user.desa'])
            ->where('qr_token', $token)
            ->first();

        if (! $dokumen) {
            return view('mesin.hasil', [
                'valid' => false,
                'message' => 'QR Code tidak valid atau dokumen tidak ditemukan.',
                'dokumen' => null,
            ]);
        }

        $pengajuan = $dokumen->pengajuanSurat;

        return view('mesin.hasil', [
            'valid' => true,
            'message' => 'Dokumen ditemukan.',
            'dokumen' => $dokumen,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function verifyAjax(Request $request)
    {
        try {
            $validated = $request->validate([
                'token' => ['required', 'string'],
            ]);

            $token = $validated['token'];

            Log::info('SADESA QR VERIFY ATTEMPT', [
                'token' => $token,
                'remote_addr' => $request->ip(),
                'url' => $request->fullUrl(),
            ]);

            $dokumen = Dokumen::with(['pengajuanSurat.jenisSurat', 'pengajuanSurat.user.desa'])
                ->where('qr_token', $token)
                ->first();

            Log::info('SADESA QR VERIFY', [
                'token' => $token,
                'dokumen_found' => (bool) $dokumen,
                'dokumen_id' => $dokumen?->id,
                'file' => $dokumen?->file,
                'dokumen_pdf' => $dokumen?->dokumen_pdf,
                'status' => $dokumen?->status,
            ]);

            if (! $dokumen) {
                Log::warning('SADESA QR INVALID', ['token' => $token]);

                return response()->json([
                    'success' => false,
                    'message' => 'QR Code tidak valid atau dokumen tidak ditemukan.',
                ], 404);
            }

            if ($dokumen->status !== 'tersedia') {
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen tidak tersedia untuk dicetak.',
                ], 422);
            }

            if ($dokumen->dicetak_at !== null) {

                try {
                    $printedAt = Carbon::parse($dokumen->dicetak_at)->timezone(config('app.timezone'))->format('d F Y H:i');
                } catch (\Throwable $_) {
                    $printedAt = (string) $dokumen->dicetak_at;
                }

                return response()->json([
                    'success' => false,
                    'already_printed' => true,
                    'message' => 'Dokumen sudah pernah dicetak pada '.$printedAt.'.',
                ]);
            }

            if ($dokumen->dokumen_pdf) {
                $exists = Storage::disk('public')->exists($dokumen->dokumen_pdf);
                if (! $exists) {
                    Log::error('SADESA DOCUMENT FILE NOT FOUND', [
                        'dokumen_id' => $dokumen->id,
                        'dokumen_pdf' => $dokumen->dokumen_pdf,
                    ]);
                }
            } else {

                $exists = Storage::disk('public')->exists($dokumen->file);
                if (! $exists) {
                    Log::error('SADESA DOCUMENT FILE NOT FOUND (file)', [
                        'dokumen_id' => $dokumen->id,
                        'file' => $dokumen->file,
                    ]);
                }
            }

            $pdfUrl = null;

            if (! empty($dokumen->dokumen_pdf) && Storage::disk('public')->exists($dokumen->dokumen_pdf)) {
                $pdfUrl = asset('storage/'.$dokumen->dokumen_pdf);
            }

            if (is_null($pdfUrl) && ! empty($dokumen->file)) {
                $ext = strtolower(pathinfo($dokumen->file, PATHINFO_EXTENSION));
                if ($ext === 'pdf' && Storage::disk('public')->exists($dokumen->file)) {
                    $pdfUrl = asset('storage/'.$dokumen->file);
                }
            }

            Log::info('SADESA MESIN PRINT', [
                'dokumen_id' => $dokumen->id,
                'nomor_dokumen' => $dokumen->nomor_dokumen,
                'file' => $dokumen->file,
                'dokumen_pdf' => $dokumen->dokumen_pdf,
                'pdf_found' => (bool) $pdfUrl,
            ]);

            if (is_null($pdfUrl)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File PDF dokumen tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'QR Code valid.',
                'already_printed' => false,
                'dokumen' => [
                    'id' => $dokumen->id,
                    'nomor_dokumen' => $dokumen->nomor_dokumen,
                    'file_url' => $pdfUrl,
                ],
            ]);

        } catch (ValidationException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('SADESA QR VERIFY ERROR', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memverifikasi QR Code.',
            ], 500);
        }
    }

    public function print(Dokumen $dokumen)
    {

        abort_unless($dokumen->status === 'tersedia' || $dokumen->status === 'dicetak', 404);

        return view('mesin.print', compact('dokumen'));
    }

    public function markPrinted(Request $request, Dokumen $dokumen, QrCodeService $qrCodeService)
    {

        $updated = DB::transaction(function () use ($dokumen, $qrCodeService) {
            $d = Dokumen::where('id', $dokumen->id)->lockForUpdate()->first();

            if (! $d) {
                return false;
            }

            if ($d->dicetak_at !== null) {

                return false;
            }

            $d->dicetak_at = now();
            $d->status = 'dicetak';

            $newToken = (string) Str::uuid();
            $d->qr_token = $newToken;

            try {
                $qrFile = $qrCodeService->generate($newToken);
                $d->qr_file = $qrFile;
            } catch (\Throwable $e) {

                throw $e;
            }

            $d->save();

            return true;
        });

        if (! $updated) {
            return response()->json(['success' => false, 'message' => 'Dokumen sudah dicetak sebelumnya.'], 409);
        }

        return response()->json(['success' => true]);
    }
}
