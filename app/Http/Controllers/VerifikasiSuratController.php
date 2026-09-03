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

        return view(
            'verifikasi-surat',
            compact('dokumen')
        );
    }
}
