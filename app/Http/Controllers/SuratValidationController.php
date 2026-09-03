<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;

class SuratValidationController extends Controller
{
    public function show(string $token)
    {
        $pengajuan = PengajuanSurat::with([
            'jenisSurat',
            'user',
        ])
            ->where('qr_token', $token)
            ->where('status', 'disetujui')
            ->firstOrFail();

        return view('surat.validasi', compact('pengajuan'));
    }
}
