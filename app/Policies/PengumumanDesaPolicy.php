<?php

namespace App\Policies;

use App\Models\PengumumanDesa;
use App\Models\User;

class PengumumanDesaPolicy
{
    public function view(User $user, PengumumanDesa $pengumuman): bool
    {
        if ($user->role === 'super_admin') {
            return true;
        }

        if ($user->role === 'masyarakat') {
            return $pengumuman->status === 'published'
                && $pengumuman->desa_id === $user->desa_id;
        }

        if ($user->role === 'admin_desa') {
            return $pengumuman->desa_id === $user->desa_id;
        }

        return false;
    }

    public function update(User $user, PengumumanDesa $pengumuman): bool
    {
        return $user->role === 'admin_desa'
            && $pengumuman->desa_id === $user->desa_id;
    }

    public function delete(User $user, PengumumanDesa $pengumuman): bool
    {
        return $this->update($user, $pengumuman);
    }
}
