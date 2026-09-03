<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProvinsiController extends Controller
{
    public function index(): View
    {
        $provinsis = Provinsi::orderBy('nama')->paginate(10);

        return view('admin.provinsi.index', compact('provinsis'));
    }

    public function create(): View
    {
        return view('admin.provinsi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:provinsis,kode'],
        ]);

        Provinsi::create($validated);

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil ditambahkan.');
    }

    public function edit(Provinsi $provinsi): View
    {
        return view('admin.provinsi.edit', compact('provinsi'));
    }

    public function update(Request $request, Provinsi $provinsi): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:provinsis,kode,' . $provinsi->id],
        ]);

        $provinsi->update($validated);

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil diperbarui.');
    }

    public function destroy(Provinsi $provinsi): RedirectResponse
    {
        if ($provinsi->kotas()->exists()) {
            return back()->withErrors('Provinsi tidak dapat dihapus karena masih memiliki data kota/kabupaten.');
        }

        $provinsi->delete();

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil dihapus.');
    }
}
