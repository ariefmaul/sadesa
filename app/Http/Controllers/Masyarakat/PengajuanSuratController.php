<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use App\Notifications\PengajuanBaruNotification;
use App\Services\SuratFieldResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengajuanSuratController extends Controller
{
    public function __construct(private readonly SuratFieldResolver $resolver) {}

    /**
     * Daftar jenis surat yang tersedia.
     */
    public function index()
    {
        if ($redirect = $this->ensureVerifiedMasyarakat()) {
            return $redirect;
        }

        $user = auth()->user();

        $surats = JenisSurat::where('aktif', true)
            ->where('desa_id', $user->desa_id)
            ->with('fields')
            ->orderBy('nama')
            ->get();

        return view(
            'masyarakat.pengajuan.index',
            compact('surats')
        );
    }

    /**
     * Menampilkan form pengajuan.
     */
    public function create(JenisSurat $jenisSurat)
    {
        abort_if(! $jenisSurat->aktif, 404);

        abort_unless(
            $jenisSurat->desa_id === auth()->user()->desa_id,
            403
        );

        if ($redirect = $this->ensureVerifiedMasyarakat()) {
            return $redirect;
        }

        $jenisSurat->load('fields');
        $readonlyFields = $this->resolver->readonlyFields($jenisSurat, auth()->user());
        $pengajuanFields = $jenisSurat->fields
            ->filter(fn ($field) => $field->sourceData() === 'pengajuan')
            ->values();

        return view(
            'masyarakat.pengajuan.create',
            compact('jenisSurat', 'readonlyFields', 'pengajuanFields')
        );
    }

    /**
     * Menyimpan pengajuan.
     */
    public function store(
        Request $request,
        JenisSurat $jenisSurat
    ) {
        abort_if(! $jenisSurat->aktif, 404);

        abort_unless(
            $jenisSurat->desa_id === $request->user()->desa_id,
            403
        );

        if ($redirect = $this->ensureVerifiedMasyarakat()) {
            return $redirect;
        }

        $jenisSurat->load('fields');

        $rules = [];

        foreach ($jenisSurat->fields->filter(fn ($field) => $field->sourceData() === 'pengajuan') as $field) {

            $rule = match ($field->inputType()) {
                'email' => 'email',
                'number' => 'numeric',
                'date' => 'date',
                default => 'string',
            };

            $rules[$field->fieldName()] =
                $field->isRequired()
                    ? 'required|'.$rule
                    : 'nullable|'.$rule;
        }

        $validated = $request->validate($rules);

        $dataPengajuan = [];

        foreach ($jenisSurat->fields->filter(fn ($field) => $field->sourceData() === 'pengajuan') as $field) {

            $dataPengajuan[$field->fieldName()] =
                $validated[$field->fieldName()] ?? null;
        }

        $nomorPengajuan =
            'PGJ-'.
            now()->format('Ymd').
            '-'.
            strtoupper(Str::random(6));

        $pengajuan = PengajuanSurat::create([
            'user_id' => $request->user()->id,
            'jenis_surat_id' => $jenisSurat->id,
            'nomor_pengajuan' => $nomorPengajuan,
            'data_pengajuan' => $dataPengajuan,
            'data_snapshot' => $this->resolver->snapshotFor($jenisSurat, $request->user(), $dataPengajuan),
            'status' => 'menunggu',
        ]);

        $adminDesa = User::query()
            ->where('role', 'admin_desa')
            ->where('desa_id', $request->user()->desa_id)
            ->get();

        foreach ($adminDesa as $admin) {
            $admin->notify(new PengajuanBaruNotification($pengajuan));
        }

        return redirect()
            ->route(
                'masyarakat.pengajuan.show',
                $pengajuan
            )
            ->with(
                'success',
                'Pengajuan surat berhasil dikirim.'
            );
    }

    /**
     * Detail pengajuan masyarakat.
     */
    public function show(PengajuanSurat $pengajuan)
    {
        $this->authorize('view', $pengajuan);

        $pengajuan->load([
            'jenisSurat',
            'dokumen',
        ]);

        return view(
            'masyarakat.pengajuan.show',
            compact('pengajuan')
        );
    }

    /**
     * Riwayat pengajuan milik user yang sedang login.
     */
    public function riwayat()
    {
        $pengajuans = PengajuanSurat::with(['jenisSurat', 'dokumen'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('masyarakat.pengajuan.riwayat', compact('pengajuans'));
    }

    private function ensureVerifiedMasyarakat()
    {
        $status = auth()->user()->status_verifikasi;

        if ($status === 'disetujui') {
            if (! auth()->user()->hasCompleteProfilMasyarakat()) {
                return redirect()
                    ->route('profile.edit')
                    ->with('error', 'Lengkapi data profil terlebih dahulu sebelum mengajukan surat.');
            }

            return null;
        }

        $message = $status === 'ditolak'
            ? 'Akun Anda ditolak. Silakan hubungi Admin Desa.'
            : 'Akun Anda belum diverifikasi oleh Admin Desa.';

        return redirect()
            ->route('dashboard')
            ->with('error', $message);
    }
}
