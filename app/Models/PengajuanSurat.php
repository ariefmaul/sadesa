<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PengajuanSurat extends Model
{
    protected $fillable = [
        'jenis_surat_id',
        'user_id',
        'nomor_pengajuan',
        'data_pengajuan',
        'data_snapshot',
        'status',
        'qr_token',
        'dokumen_word',
        'dokumen_pdf',
        'disetujui_at',
    ];

    protected function casts(): array
    {
        return [
            'data_pengajuan' => 'array',
            'data_snapshot' => 'array',
            'verified_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function dokumen(): HasOne
    {
        return $this->hasOne(Dokumen::class);
    }
}
