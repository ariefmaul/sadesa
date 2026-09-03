<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasyarakatVerificationController extends Controller
{
    public function index(Request $request): View
    {
        $admin = $request->user();
        $status = $request->string('status')->toString() ?: 'menunggu';

        $masyarakat = User::query()
            ->where('role', 'masyarakat')
            ->where('desa_id', $admin->desa_id)
            ->where('status_verifikasi', $status)
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.masyarakat.index', compact('masyarakat', 'status'));
    }

    public function show(Request $request, User $masyarakat): View
    {
        $this->authorizeMasyarakatInAdminDesa($request, $masyarakat);

        return view('admin.masyarakat.show', compact('masyarakat'));
    }

    public function approve(Request $request, User $masyarakat): RedirectResponse
    {
        $this->authorizeMasyarakatInAdminDesa($request, $masyarakat);

        $masyarakat->update(['status_verifikasi' => 'disetujui']);

        return redirect()
            ->route('admin.masyarakat.index')
            ->with('success', 'Masyarakat berhasil disetujui.');
    }

    public function reject(Request $request, User $masyarakat): RedirectResponse
    {
        $this->authorizeMasyarakatInAdminDesa($request, $masyarakat);

        $masyarakat->update(['status_verifikasi' => 'ditolak']);

        return redirect()
            ->route('admin.masyarakat.index')
            ->with('success', 'Masyarakat berhasil ditolak.');
    }

    private function authorizeMasyarakatInAdminDesa(Request $request, User $masyarakat): void
    {
        abort_unless(
            $masyarakat->role === 'masyarakat'
            && $masyarakat->desa_id === $request->user()->desa_id,
            403
        );
    }
}
