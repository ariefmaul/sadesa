<?php

namespace App\Policies;

use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanSuratPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pengajuan (admin view).
     */
    public function view(User $user, PengajuanSurat $pengajuan): bool
    {
        // Owner can always view their own pengajuan
        if ($user->id === $pengajuan->user_id) {
            return true;
        }

        if ($user->role === 'super_admin') {
            return true;
        }

        if ($user->role === 'admin_desa') {
            // allow if pengajuannya dari desa yang sama
            return $pengajuan->user && $pengajuan->user->desa_id === $user->desa_id;
        }

        // other roles not allowed here
        return false;
    }

    /**
     * Determine whether the user can approve the pengajuan.
     */
    public function approve(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }

    /**
     * Determine whether the user can download the pengajuan's dokumen.
     */
    public function download(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }

    /**
     * Determine whether the user can print the pengajuan's dokumen.
     */
    public function print(User $user, PengajuanSurat $pengajuan): bool
    {
        // printing usually handled by mesin; admin_desa and super_admin allowed
        if ($user->role === 'super_admin') return true;
        if ($user->role === 'admin_desa') return $this->view($user, $pengajuan);
        return false;
    }

    /**
     * Determine whether the user can reject the pengajuan.
     */
    public function reject(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }
}
