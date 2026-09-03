<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DesaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $desas = Desa::query()
            ->withCount('users')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.desa.index', compact('desas', 'search'));
    }

    public function create(): View
    {
        $kecamatans = \App\Models\Kecamatan::with('kota.provinsi')->orderBy('nama')->get();

        return view('admin.desa.create', compact('kecamatans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:desas,kode'],
            'kecamatan_id' => ['nullable', 'exists:kecamatans,id'],
        ]);

        Desa::create($validated);

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Data desa berhasil ditambahkan.');
    }

    public function edit(Desa $desa): View
    {
        $kecamatans = \App\Models\Kecamatan::with('kota.provinsi')->orderBy('nama')->get();

        return view('admin.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, Desa $desa): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('desas', 'kode')->ignore($desa),
            ],
            'kecamatan_id' => ['nullable', 'exists:kecamatans,id'],
        ]);

        $desa->update($validated);

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Data desa berhasil diperbarui.');
    }

    public function destroy(Desa $desa): RedirectResponse
    {
        if ($desa->users()->exists()) {
            return back()->withErrors('Desa tidak dapat dihapus karena masih memiliki user terhubung.');
        }

        $desa->delete();

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Data desa berhasil dihapus.');
    }
}
