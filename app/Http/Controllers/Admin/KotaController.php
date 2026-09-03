<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KotaController extends Controller
{
    public function index(): View
    {
        $kotas = Kota::with('provinsi')->orderBy('nama')->paginate(10);

        return view('admin.kota.index', compact('kotas'));
    }

    public function create(): View
    {
        $provinsis = Provinsi::orderBy('nama')->get();
        return view('admin.kota.create', compact('provinsis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'provinsi_id' => ['required', 'exists:provinsis,id'],
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:kotas,kode'],
        ]);

        Kota::create($validated);

        return redirect()->route('admin.kota.index')->with('success', 'Kota/Kabupaten berhasil ditambahkan.');
    }

    public function edit(Kota $kota): View
    {
        $provinsis = Provinsi::orderBy('nama')->get();
        return view('admin.kota.edit', compact('kota', 'provinsis'));
    }

    public function update(Request $request, Kota $kota): RedirectResponse
    {
        $validated = $request->validate([
            'provinsi_id' => ['required', 'exists:provinsis,id'],
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:kotas,kode,' . $kota->id],
        ]);

        $kota->update($validated);

        return redirect()->route('admin.kota.index')->with('success', 'Kota/Kabupaten berhasil diperbarui.');
    }

    public function destroy(Kota $kota): RedirectResponse
    {
        if ($kota->kecamatans()->exists()) {
            return back()->withErrors('Kota/Kabupaten tidak dapat dihapus karena masih memiliki data kecamatan.');
        }

        $kota->delete();

        return redirect()->route('admin.kota.index')->with('success', 'Kota/Kabupaten berhasil dihapus.');
    }
}
