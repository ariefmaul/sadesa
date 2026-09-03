<?php

namespace App\Http\Controllers\Mesin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class MesinController extends Controller
{
    public function dashboard()
    {
        return view('mesin.dashboard');
    }

    public function scan()
    {
        return view('mesin.scan');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
        ]);

        $dokumen = Dokumen::with([
            'pengajuan.user',
            'pengajuan.jenisSurat',
        ])
            ->where('qr_token', $request->token)
            ->where('status', 'tersedia')
            ->first();

        if (! $dokumen) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid atau dokumen tidak tersedia.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $dokumen->id,
                'nomor_dokumen' => $dokumen->nomor_dokumen,
                'nomor_pengajuan' => $dokumen->pengajuan->nomor_pengajuan,
                'nama' => $dokumen->pengajuan->user->name,
                'jenis_surat' => $dokumen->pengajuan->jenisSurat->nama,
                'file' => $dokumen->file,
            ],
        ]);
    }

    public function print(Dokumen $dokumen)
    {
        abort_unless($dokumen->status === 'tersedia', 404);

        return view('mesin.print', compact('dokumen'));
    }
}
