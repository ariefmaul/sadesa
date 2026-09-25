<?php

namespace App\Policies;

use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanSuratPolicy
{
    use HandlesAuthorization;

    public function view(User $user, PengajuanSurat $pengajuan): bool
    {

        if ($user->id === $pengajuan->user_id) {
            return true;
        }

        if ($user->role === 'super_admin') {
            return true;
        }

        if ($user->role === 'admin_desa') {

            return $pengajuan->user && $pengajuan->user->desa_id === $user->desa_id;
        }

        return false;
    }

    public function approve(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }

    public function download(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }

    public function print(User $user, PengajuanSurat $pengajuan): bool
    {

        if ($user->role === 'super_admin') {
            return true;
        }
        if ($user->role === 'admin_desa') {
            return $this->view($user, $pengajuan);
        }

        return false;
    }

    public function reject(User $user, PengajuanSurat $pengajuan): bool
    {
        return $this->view($user, $pengajuan);
    }
}
