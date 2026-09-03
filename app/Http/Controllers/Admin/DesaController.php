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
        return view('admin.desa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:50', 'unique:desas,kode'],
        ]);

        Desa::create($validated);

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Data desa berhasil ditambahkan.');
    }

    public function edit(Desa $desa): View
    {
        return view('admin.desa.edit', compact('desa'));
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
