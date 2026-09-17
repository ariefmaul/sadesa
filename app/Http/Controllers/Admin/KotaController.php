<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KotaController extends Controller
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
        $q = trim((string) request()->get('q', ''));

        if ($kotaId) {
            $kotaQuery = Kota::query()->where('id', $kotaId);

            if ($provinsiId) {
                $kotaQuery->where('provinsi_id', $provinsiId);
            }

            if (! $kotaQuery->exists()) {
                $kotaId = null;
            }
        }

        $provinsis = Provinsi::query()->select(['id', 'nama'])->orderBy('nama')->get();

        $kotasQuery = Kota::query()
            ->select(['id', 'provinsi_id', 'nama', 'kode'])
            ->with(['provinsi:id,nama'])
            ->when($provinsiId, function ($query) use ($provinsiId) {
                $query->where('provinsi_id', $provinsiId);
            })
            ->when($q, function ($query) use ($q) {
                $query->where('nama', 'like', "%{$q}%");
            })
            ->orderBy('nama');

        $kotas = $kotasQuery->paginate($perPage)->withQueryString();

        return view('admin.kota.index', [
            'kotas' => $kotas,
            'perPage' => $perPage,
            'provinsis' => $provinsis,
            'provinsiId' => $provinsiId,
            'kotaId' => $kotaId,
            'q' => $q,
        ]);
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
            'kode' => ['nullable', 'string', 'max:50', 'unique:kotas,kode,'.$kota->id],
        ]);

        $kota->update($validated);

        return redirect()->route('admin.kota.index')->with('success', 'Kota/Kabupaten berhasil diperbarui.');
    }

    public function destroy(Kota $kota): RedirectResponse
    {
        if ($kota->kecamatans()->exists()) {
            return back()->with(
                'error',
                'Kota/Kabupaten tidak dapat dihapus karena masih memiliki data kecamatan. Hapus data kecamatan terlebih dahulu.'
            );
        }

        $kota->delete();

        return redirect()->route('admin.kota.index')->with('success', 'Kota/Kabupaten berhasil dihapus.');
    }
}
