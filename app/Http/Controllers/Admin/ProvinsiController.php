<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProvinsiController extends Controller
{
    public function index(): View
    {
        $perPage = request()->get('per_page', 10);
        $search = trim((string) request()->get('search', ''));

        // Batasi pilihan agar tidak sembarang angka masuk
        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array((int) $perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $provinsis = Provinsi::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.provinsi.index', compact('provinsis', 'perPage', 'search'));
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
            'kode' => ['nullable', 'string', 'max:50', 'unique:provinsis,kode,'.$provinsi->id],
        ]);

        $provinsi->update($validated);

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil diperbarui.');
    }

    public function destroy(Provinsi $provinsi): RedirectResponse
    {
        if ($provinsi->kotas()->exists()) {
            return back()->with(
                'error',
                'Provinsi tidak dapat dihapus karena masih memiliki data kota/kabupaten. Hapus data kota/kabupaten terlebih dahulu.'
            );
        }

        $provinsi->delete();

        return redirect()->route('admin.provinsi.index')->with('success', 'Provinsi berhasil dihapus.');
    }
}
