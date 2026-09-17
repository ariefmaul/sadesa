<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    public function index(): View
    {
        $perPage = (int) request()->get('per_page', 10);

        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $provinsiId = request()->get('provinsi_id');
        $kotaId = request()->get('kota_id');
        $search = trim((string) request()->get('search', ''));

        // Semua provinsi untuk filter
        $provinsis = Provinsi::orderBy('nama')->get();

        $kotas = Kota::query()
            ->when($provinsiId, function ($query) use ($provinsiId) {
                $query->where('provinsi_id', $provinsiId);
            })
            ->with('provinsi')
            ->orderBy('nama')
            ->get();

        // Data kecamatan
        $kecamatans = Kecamatan::with('kota.provinsi')
            ->when($provinsiId, function ($query) use ($provinsiId) {
                $query->whereHas('kota', function ($query) use ($provinsiId) {
                    $query->where('provinsi_id', $provinsiId);
                });
            })
            ->when($kotaId, function ($query) use ($kotaId) {
                $query->where('kota_id', $kotaId);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.kecamatan.index', [
            'kecamatans' => $kecamatans,
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'perPage' => $perPage,
            'search' => $search,
        ]);
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
            'kode' => ['nullable', 'string', 'max:50', 'unique:kecamatans,kode,'.$kecamatan->id],
        ]);

        $kecamatan->update($validated);

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui.');
    }

    public function destroy(Kecamatan $kecamatan): RedirectResponse
    {
        if ($kecamatan->desas()->exists()) {
            return back()->with(
                'error',
                'Kecamatan tidak dapat dihapus karena masih memiliki data desa. Hapus data desa terlebih dahulu.'
            );
        }

        $kecamatan->delete();

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil dihapus.');
    }
}