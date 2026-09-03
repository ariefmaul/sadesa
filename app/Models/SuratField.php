<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratField extends Model
{
    protected $fillable = [
        'jenis_surat_id',
        'nama_field',
        'label',
        'sumber_data',
        'tipe',
        'wajib',
        'name',
        'type',
        'required',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'required' => 'boolean',
            'wajib' => 'boolean',
        ];
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function fieldName(): string
    {
        return $this->nama_field ?: $this->name;
    }

    public function inputType(): string
    {
        return $this->tipe ?: $this->type ?: 'text';
    }

    public function isRequired(): bool
    {
        return $this->wajib ?? $this->required ?? true;
    }

    public function sourceData(): string
    {
        return $this->sumber_data ?: 'pengajuan';
    }
}
