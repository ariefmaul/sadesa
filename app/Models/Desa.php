<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desa extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'kecamatan_id',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function pengumumanDesas(): HasMany
    {
        return $this->hasMany(PengumumanDesa::class);
    }

    public function transparansiAnggarans(): HasMany
    {
        return $this->hasMany(TransparansiAnggaran::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
