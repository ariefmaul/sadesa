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
        'options',
    ];

    protected function casts(): array
    {
        return [
            'required' => 'boolean',
            'wajib' => 'boolean',
            'options' => 'array',
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

    public function selectOptions(): array
    {
        $options = $this->options ?? [];

        if (is_string($options)) {
            $options = json_decode($options, true);
        }

        if (! is_array($options)) {
            return [];
        }

        return array_values(array_filter(array_map(function ($option) {
            $value = trim((string) $option);

            return $value !== '' ? $value : null;
        }, $options)));
    }

    public function selectOptionsText(): string
    {
        return implode("\n", $this->selectOptions());
    }
}
