<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// models used: Desa is not needed directly here any more
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminDesaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $admins = User::query()
            ->with('desa')
            ->where('role', 'admin_desa')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.admin-desa.index', compact('admins', 'search'));
    }

    public function create(): View
    {
        $provinsis = \App\Models\Provinsi::orderBy('nama')->get();

        return view('admin.admin-desa.create', compact('provinsis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'digits:16', 'unique:users,nik'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'desa_id' => ['required', 'exists:desas,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'nik' => $validated['nik'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'desa_id' => $validated['desa_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin_desa',
            'status_verifikasi' => 'disetujui',
        ]);

        return redirect()
            ->route('admin.admin-desa.index')
            ->with('success', 'Akun Admin Desa berhasil dibuat.');
    }

    public function edit(User $adminDesa): View
    {
        abort_unless($adminDesa->role === 'admin_desa', 404);

        $provinsis = \App\Models\Provinsi::orderBy('nama')->get();

        // determine selected region ids for the edit form
        $selectedProvinsi = null;
        $selectedKota = null;
        $selectedKecamatan = null;
        $selectedDesa = $adminDesa->desa_id;

        if ($adminDesa->desa && $adminDesa->desa->kecamatan) {
            $selectedKecamatan = $adminDesa->desa->kecamatan->id;
            if ($adminDesa->desa->kecamatan->kota) {
                $selectedKota = $adminDesa->desa->kecamatan->kota->id;
                if ($adminDesa->desa->kecamatan->kota->provinsi) {
                    $selectedProvinsi = $adminDesa->desa->kecamatan->kota->provinsi->id;
                }
            }
        }

        return view('admin.admin-desa.edit', compact('adminDesa', 'provinsis', 'selectedProvinsi', 'selectedKota', 'selectedKecamatan', 'selectedDesa'));
    }

    public function update(Request $request, User $adminDesa): RedirectResponse
    {
        abort_unless($adminDesa->role === 'admin_desa', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'digits:16', Rule::unique('users', 'nik')->ignore($adminDesa)],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'desa_id' => ['required', 'exists:desas,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($adminDesa)],
            'status_verifikasi' => ['required', Rule::in(['disetujui', 'ditolak'])],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $adminDesa->fill([
            'name' => $validated['name'],
            'nik' => $validated['nik'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'desa_id' => $validated['desa_id'],
            'email' => $validated['email'],
            'status_verifikasi' => $validated['status_verifikasi'],
            'role' => 'admin_desa',
        ]);

        if (! empty($validated['password'])) {
            $adminDesa->password = Hash::make($validated['password']);
        }

        $adminDesa->save();

        return redirect()
            ->route('admin.admin-desa.index')
            ->with('success', 'Akun Admin Desa berhasil diperbarui.');
    }

    public function destroy(User $adminDesa): RedirectResponse
    {
        abort_unless($adminDesa->role === 'admin_desa', 404);

        $adminDesa->delete();

        return redirect()
            ->route('admin.admin-desa.index')
            ->with('success', 'Akun Admin Desa berhasil dihapus.');
    }
}
