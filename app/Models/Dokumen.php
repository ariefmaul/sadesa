<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokumen extends Model
{
    protected $fillable = [
        'pengajuan_surat_id',
        'nomor_dokumen',
        'nomor_surat',
        'file',
        'dokumen_pdf',
        'qr_file',
        'qr_token',
        'status',
        'dicetak_at',
    ];

    protected function casts(): array
    {
        return [
            'dicetak_at' => 'datetime',
        ];
    }

    public function pengajuanSurat(): BelongsTo
    {
        return $this->belongsTo(PengajuanSurat::class);
    }
}
