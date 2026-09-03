<?php

namespace App\Policies;

use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DokumenPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Dokumen $dokumen): bool
    {
        // Super admin can view everything
        if ($user->role === 'super_admin') return true;

        // Owner of the pengajuan
        if ($dokumen->pengajuanSurat && $dokumen->pengajuanSurat->user_id === $user->id) {
            return true;
        }

        // Admin desa may view if same desa as pengaju
        if ($user->role === 'admin_desa' && $dokumen->pengajuanSurat && $dokumen->pengajuanSurat->user && $dokumen->pengajuanSurat->user->desa_id === $user->desa_id) {
            return true;
        }

        return false;
    }

    public function download(User $user, Dokumen $dokumen): bool
    {
        return $this->view($user, $dokumen);
    }

    public function print(User $user, Dokumen $dokumen): bool
    {
        // mesin role handled by middleware, but also allow super_admin
        if ($user->role === 'super_admin') return true;

        // admin desa can print for same desa
        if ($user->role === 'admin_desa' && $dokumen->pengajuanSurat && $dokumen->pengajuanSurat->user && $dokumen->pengajuanSurat->user->desa_id === $user->desa_id) {
            return true;
        }

        // owner cannot print via mesin endpoints
        return false;
    }
}
