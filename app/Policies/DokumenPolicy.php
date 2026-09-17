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
        
        if ($user->role === 'super_admin') return true;

        
        if ($dokumen->pengajuanSurat && $dokumen->pengajuanSurat->user_id === $user->id) {
            return true;
        }

        
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
        
        if ($user->role === 'super_admin') return true;

        
        if ($user->role === 'admin_desa' && $dokumen->pengajuanSurat && $dokumen->pengajuanSurat->user && $dokumen->pengajuanSurat->user->desa_id === $user->desa_id) {
            return true;
        }

        
        return false;
    }
}
