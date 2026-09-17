<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilMasyarakatController extends Controller
{
    public function edit(Request $request): RedirectResponse
    {
        
        return redirect()->route('profile.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_kk' => ['nullable', 'string', 'max:16'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'dusun' => ['nullable', 'string', 'max:100'],
            'agama' => ['nullable', 'string', 'max:50'],
            'status_perkawinan' => ['nullable', 'string', 'max:50'],
            'pekerjaan' => ['nullable', 'string', 'max:100'],
            'kewarganegaraan' => ['nullable', 'string', 'max:50'],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);

        $request->user()->profilMasyarakat()->updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return redirect()
            ->route('masyarakat.profil.edit')
            ->with('success', 'Profil masyarakat berhasil diperbarui.');
    }
}
