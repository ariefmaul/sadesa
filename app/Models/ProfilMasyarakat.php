<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilMasyarakat extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'no_hp',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isComplete(): bool
    {
        return filled($this->tempat_lahir)
            && filled($this->tanggal_lahir)
            && filled($this->alamat);
    }
}
