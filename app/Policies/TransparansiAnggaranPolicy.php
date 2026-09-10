<?php

namespace App\Policies;

use App\Models\TransparansiAnggaran;
use App\Models\User;

class TransparansiAnggaranPolicy
{
    public function view(User $user, TransparansiAnggaran $transparansi): bool
    {
        if ($user->role === 'super_admin') {
            return true;
        }

        if ($user->role === 'masyarakat') {
            return $transparansi->status === 'published'
                && $transparansi->desa_id === $user->desa_id;
        }

        if ($user->role === 'admin_desa') {
            return $transparansi->desa_id === $user->desa_id;
        }

        return false;
    }

    public function download(User $user, TransparansiAnggaran $transparansi): bool
    {
        return $this->view($user, $transparansi);
    }

    public function update(User $user, TransparansiAnggaran $transparansi): bool
    {
        return $user->role === 'admin_desa'
            && $transparansi->desa_id === $user->desa_id;
    }

    public function delete(User $user, TransparansiAnggaran $transparansi): bool
    {
        return $this->update($user, $transparansi);
    }
}
