<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'nik',
    'jenis_kelamin',
    'desa_id',
    'email',
    'password',
    'role',
    'status_verifikasi', ])]

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengajuanSurats()
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function profilMasyarakat(): HasOne
    {
        return $this->hasOne(ProfilMasyarakat::class);
    }

    public function hasCompleteProfilMasyarakat(): bool
    {
        return $this->profilMasyarakat?->isComplete() ?? false;
    }
}
