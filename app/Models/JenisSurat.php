<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'template',
        'aktif',
    ];

    public function pengajuanSurats(): HasMany
    {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(SuratField::class)
            ->orderBy('urutan');
    }
}
