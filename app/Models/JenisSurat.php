<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisSurat extends Model
{
    protected $fillable = [
        'nama',
        'desa_id',
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

    public function desa(): BelongsTo
    {
        return $this->belongsTo(Desa::class);
    }

    public function scopeForDesa($query, $desaId)
    {
        return $query->where('desa_id', $desaId);
    }
}
