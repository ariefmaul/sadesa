<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DesaController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = (int) $request->get('per_page', 10);
        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $search = trim((string) $request->input('search', ''));
        $provinsiId = $request->input('provinsi_id');
        $kotaId = $request->input('kota_id');

        $provinsis = Provinsi::query()->select(['id', 'nama'])->orderBy('nama')->get();

        $kotas = Kota::query()
            ->select(['id', 'nama', 'provinsi_id'])
            ->when($provinsiId, function ($query) use ($provinsiId) {
                $query->where('provinsi_id', $provinsiId);
            })
            ->orderBy('nama')
            ->get();

        $desas = Desa::query()
            ->select(['id', 'nama', 'kode', 'kecamatan_id'])
            ->withCount('users')
            ->when($provinsiId, function ($query) use ($provinsiId) {
                $query->whereHas('kecamatan.kota', function ($query) use ($provinsiId) {
                    $query->where('provinsi_id', $provinsiId);
                });
            })
            ->when($kotaId, function ($query) use ($kotaId) {
                $query->whereHas('kecamatan', function ($query) use ($kotaId) {
                    $query->where('kota_id', $kotaId);
                });
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama', 'like', "%{$search}%")
                        ->orWhere('kode', 'like', "%{$search}%");
                });
            })
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.desa.index', compact('desas', 'search', 'perPage', 'provinsis', 'kotas', 'provinsiId', 'kotaId'));
    }

    public function create(): View
    {
        $kecamatans = Kecamatan::with('kota.provinsi')->orderBy('nama')->get();

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
        $kecamatans = Kecamatan::with('kota.provinsi')->orderBy('nama')->get();

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
            return back()->with(
                'error',
                'Desa tidak dapat dihapus karena masih memiliki user terhubung. Hapus atau pindahkan user terlebih dahulu.'
            );
        }

        $desa->delete();

        return redirect()
            ->route('admin.desa.index')
            ->with('success', 'Data desa berhasil dihapus.');
    }
}
