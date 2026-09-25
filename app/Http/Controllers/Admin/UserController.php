<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = (int) $request->get('per_page', 10);
        $allowedPerPage = [10, 25, 50, 100];

        if (! in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $search = trim((string) $request->input('search', ''));
        $role = $request->input('role');
        $status = $request->input('status');

        $query = User::query()
            ->select(['id', 'name', 'nik', 'email', 'role', 'desa_id', 'status_verifikasi'])
            ->with(['desa:id,nama'])
            ->where('role', '!=', 'super_admin');

        if (auth()->user()->role === 'admin_desa') {
            $query->where('desa_id', auth()->user()->desa_id);
        }

        $users = $query
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($role, function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status_verifikasi', $status);
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search', 'perPage', 'role', 'status'));
    }

    public function desaIndex(Request $request): View
    {
        return $this->index($request);
    }

    public function create(): View
    {
        if (auth()->user()->role === 'admin_desa') {
            $provinsis = Provinsi::query()->orderBy('nama')->get();

            return view('admin.users.create', compact('provinsis'));
        }

        $provinsis = Provinsi::query()->orderBy('nama')->get();

        return view('admin.users.create', compact('provinsis'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->role === 'admin_desa') {
            $request->merge(['desa_id' => auth()->user()->desa_id]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'digits:16', 'unique:users,nik'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'desa_id' => ['required', 'exists:desas,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'role' => ['nullable', Rule::in(['masyarakat', 'admin_desa', 'mesin'])],
            'status_verifikasi' => ['required', Rule::in(['menunggu', 'disetujui', 'ditolak'])],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['role'] = $validated['role'] ?? 'masyarakat';

        if (auth()->user()->role === 'admin_desa') {
            abort_unless((int) $validated['desa_id'] === (int) auth()->user()->desa_id, 403);
        }

        User::create([
            'name' => $validated['name'],
            'nik' => $validated['nik'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'desa_id' => $validated['desa_id'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status_verifikasi' => $validated['status_verifikasi'],
        ]);

        $redirectRoute = auth()->user()->role === 'admin_desa' ? 'admin.akun.index' : 'admin.users.index';

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Akun pengguna berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        abort_unless($user->role !== 'super_admin', 404);

        if (auth()->user()->role === 'admin_desa') {
            abort_unless((int) $user->desa_id === (int) auth()->user()->desa_id, 403);
        }

        $provinsis = Provinsi::query()->orderBy('nama')->get();

        $selectedProvinsi = null;
        $selectedKota = null;
        $selectedKecamatan = null;
        $selectedDesa = $user->desa_id;

        if ($user->desa && $user->desa->kecamatan) {
            $selectedKecamatan = $user->desa->kecamatan->id;

            if ($user->desa->kecamatan->kota) {
                $selectedKota = $user->desa->kecamatan->kota->id;

                if ($user->desa->kecamatan->kota->provinsi) {
                    $selectedProvinsi = $user->desa->kecamatan->kota->provinsi->id;
                }
            }
        }

        return view('admin.users.edit', compact('user', 'provinsis', 'selectedProvinsi', 'selectedKota', 'selectedKecamatan', 'selectedDesa'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_unless($user->role !== 'super_admin', 404);

        if (auth()->user()->role === 'admin_desa') {
            abort_unless((int) $user->desa_id === (int) auth()->user()->desa_id, 403);
            $request->merge(['desa_id' => auth()->user()->desa_id]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'digits:16', Rule::unique('users', 'nik')->ignore($user)],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'desa_id' => ['required', 'exists:desas,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'role' => ['nullable', Rule::in(['masyarakat', 'admin_desa', 'mesin'])],
            'status_verifikasi' => ['required', Rule::in(['menunggu', 'disetujui', 'ditolak'])],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['role'] = $validated['role'] ?? $user->role;

        $user->fill([
            'name' => $validated['name'],
            'nik' => $validated['nik'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'desa_id' => $validated['desa_id'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status_verifikasi' => $validated['status_verifikasi'],
        ]);

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $redirectRoute = auth()->user()->role === 'admin_desa' ? 'admin.akun.index' : 'admin.users.index';

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Akun pengguna berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless($user->role !== 'super_admin', 404);

        if (auth()->user()->role === 'admin_desa') {
            abort_unless((int) $user->desa_id === (int) auth()->user()->desa_id, 403);
        }

        if ((int) $user->id === (int) auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun diri sendiri.');
        }

        $user->delete();

        $redirectRoute = auth()->user()->role === 'admin_desa' ? 'admin.akun.index' : 'admin.users.index';

        return redirect()
            ->route($redirectRoute)
            ->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
