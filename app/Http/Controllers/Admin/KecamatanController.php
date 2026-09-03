<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    public function index(): View
    {
        $kecamatans = Kecamatan::with('kota')->orderBy('nama')->paginate(10);

        return view('admin.kecamatan.index', compact('kecamatans'));
    }

    public function create(): View
    {
        $kotas = Kota::with('provinsi')->orderBy('nama')->get();
        return view('admin.kecamatan.create', compact('kotas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kota_id' => ['required', 'exists:kotas,id'],
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:kecamatans,kode'],
        ]);

        Kecamatan::create($validated);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    public function edit(Kecamatan $kecamatan): View
    {
        $kotas = Kota::with('provinsi')->orderBy('nama')->get();
        return view('admin.kecamatan.edit', compact('kecamatan', 'kotas'));
    }

    public function update(Request $request, Kecamatan $kecamatan): RedirectResponse
    {
        $validated = $request->validate([
            'kota_id' => ['required', 'exists:kotas,id'],
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:kecamatans,kode,' . $kecamatan->id],
        ]);

        $kecamatan->update($validated);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui.');
    }

    public function destroy(Kecamatan $kecamatan): RedirectResponse
    {
        if ($kecamatan->desas()->exists()) {
            return back()->withErrors('Kecamatan tidak dapat dihapus karena masih memiliki data desa.');
        }

        $kecamatan->delete();

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil dihapus.');
    }
}
