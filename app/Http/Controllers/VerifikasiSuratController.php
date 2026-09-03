<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;

class VerifikasiSuratController extends Controller
{
    public function show(string $token)
    {
        $dokumen = Dokumen::with([
            'pengajuanSurat.user',
            'pengajuanSurat.jenisSurat',
        ])
            ->where('qr_token', $token)
            ->where('status', 'tersedia')
            ->firstOrFail();

        // Limit exposed data for public verification to avoid leaking PII
        $public = (object) [
            'id' => $dokumen->id,
            'nomor_dokumen' => $dokumen->nomor_dokumen,
            'nomor_surat' => $dokumen->nomor_surat,
            'jenis_surat' => $dokumen->pengajuanSurat->jenisSurat->nama ?? null,
            'status' => $dokumen->status,
            'qr_token' => $dokumen->qr_token,
        ];

        return view(
            'verifikasi-surat',
            ['dokumen' => $public]
        );
    }
}
