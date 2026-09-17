<?php

namespace App\Services;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Log;

class SuratFieldResolver
{
    public function automaticData(User $user): array
    {
        $user->loadMissing(['desa', 'profilMasyarakat']);

        $profil = $user->profilMasyarakat;
        $desa = $user->desa;

        return [
            'user' => [
                'nama' => $user->name,
                'name' => $user->name,
                'nik' => $user->nik,
                'jenis_kelamin' => $this->formatJenisKelamin($user->jenis_kelamin),
                'email' => $user->email,
            ],
            'profil' => [
                'nomor_kk' => $profil?->nomor_kk,
                'tempat_lahir' => $profil?->tempat_lahir,
                'tanggal_lahir' => $this->formatDate($profil?->tanggal_lahir),
                
                'tempat_tanggal_lahir' => trim(($profil?->tempat_lahir ? $profil->tempat_lahir.', ' : '').($this->formatDate($profil?->tanggal_lahir) ?? '')) ?: null,
                'alamat' => $profil?->alamat,
                'rt' => $profil?->rt,
                'rw' => $profil?->rw,
                'dusun' => $profil?->dusun,
                'agama' => $profil?->agama,
                'status_perkawinan' => $profil?->status_perkawinan,
                'pekerjaan' => $profil?->pekerjaan,
                'kewarganegaraan' => $profil?->kewarganegaraan,
                'no_hp' => $profil?->no_hp,
            ],
            'desa' => [
                'nama_desa' => $desa?->nama,
                'kode_desa' => $desa?->kode,
            ],
        ];
    }

    public function readonlyFields(JenisSurat $jenisSurat, User $user): array
    {
        $data = $this->automaticData($user);

        return $jenisSurat->fields
            ->filter(fn ($field) => $field->sourceData() !== 'pengajuan')
            ->map(fn ($field) => [
                'name' => $field->fieldName(),
                'label' => $field->label,
                'sumber_data' => $field->sourceData(),
                'value' => data_get($data, $field->sourceData().'.'.$field->fieldName()),
            ])
            ->values()
            ->all();
    }

    public function snapshotFor(JenisSurat $jenisSurat, User $user, array $dataPengajuan): array
    {
        $automatic = $this->automaticData($user);
        $snapshot = [];

        
        
        if ($jenisSurat->fields->isEmpty()) {
            
            $flat = [];
            
            foreach ($automatic['user'] ?? [] as $k => $v) {
                $flat[$k] = $v;
            }
            
            foreach ($automatic['profil'] ?? [] as $k => $v) {
                if (! isset($flat[$k]) || $flat[$k] === null || $flat[$k] === '') {
                    $flat[$k] = $v;
                }
            }
            
            foreach ($automatic['desa'] ?? [] as $k => $v) {
                if (! isset($flat[$k]) || $flat[$k] === null || $flat[$k] === '') {
                    $flat[$k] = $v;
                }
            }

            
            return array_merge($flat, $dataPengajuan ?? []);
        }

        
        
        foreach ($automatic['user'] ?? [] as $k => $v) {
            $snapshot[$k] = $v;
        }
        foreach ($automatic['profil'] ?? [] as $k => $v) {
            if (! isset($snapshot[$k]) || $snapshot[$k] === null || $snapshot[$k] === '') {
                $snapshot[$k] = $v;
            }
        }
        foreach ($automatic['desa'] ?? [] as $k => $v) {
            if (! isset($snapshot[$k]) || $snapshot[$k] === null || $snapshot[$k] === '') {
                $snapshot[$k] = $v;
            }
        }

        
        foreach ($jenisSurat->fields as $field) {
            $name = $field->fieldName();
            $source = $field->sourceData();

            
            $sourceNormalized = match (strtolower($source)) {
                'profile' => 'profil',
                'profil' => 'profil',
                'user' => 'user',
                'desa' => 'desa',
                default => $source,
            };

            if ($sourceNormalized === 'pengajuan') {
                
                $snapshot[$name] = $dataPengajuan[$name] ?? null;

                continue;
            }

            
            
            $existing = $snapshot[$name] ?? null;

            if ($existing === null || $existing === '') {
                $value = data_get($automatic, "{$sourceNormalized}.{$name}");

                if (($value === null || $value === '') && $sourceNormalized === 'profil') {
                    $value = data_get($automatic, "user.{$name}");
                }

                if (($value === null || $value === '') && $sourceNormalized === 'user') {
                    $value = data_get($automatic, "profil.{$name}");
                }

                if (($value === null || $value === '') && $sourceNormalized === 'desa') {
                    $value = data_get($automatic, "desa.{$name}");
                }

                $snapshot[$name] = $value ?? null;
            } else {
                
                $snapshot[$name] = $existing;
            }
        }

        
        Log::info('SADESA SNAPSHOT DEBUG', [
            'user_id' => $user->id ?? null,
            'pengajuan_fields' => $dataPengajuan,
            'snapshot' => $snapshot,
            'fields' => $jenisSurat->fields->map(fn ($f) => [
                'field_name' => $f->fieldName(),
                'source_data' => $f->sourceData(),
            ])->values()->all(),
        ]);

        return $snapshot;
    }

    public function templateData(PengajuanSurat $pengajuan): array
    {
        $pengajuan->loadMissing(['jenisSurat.fields', 'user.desa', 'user.profilMasyarakat']);

        
        $snapshot = $pengajuan->data_snapshot ?? $this->snapshotFor(
            $pengajuan->jenisSurat,
            $pengajuan->user,
            $pengajuan->data_pengajuan ?? []
        );

        
        $data = array_merge($snapshot, $pengajuan->data_pengajuan ?? []);

        
        
        foreach ($data as $key => $val) {
            $formatted = $this->formatDate($val);
            if ($formatted !== $val) {
                $data[$key] = $formatted;
            }
        }

        
        Log::info('SADESA TEMPLATE DATA DEBUG', [
            'pengajuan_id' => $pengajuan->id ?? null,
            'snapshot' => $snapshot,
            'pengajuan_data' => $pengajuan->data_pengajuan ?? [],
            'template_data' => $data,
        ]);

        return $data;
    }

    private function formatJenisKelamin(?string $value): ?string
    {
        return match ($value) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => $value,
        };
    }

    private function formatDate(mixed $value): ?string
    {
        if ($value instanceof CarbonInterface) {
            try {
                return $value->locale('id')->translatedFormat('d F Y');
            } catch (\Throwable $_) {
                return $value->translatedFormat('d F Y');
            }
        }

        if (is_string($value)) {
            
            if (preg_match('/^\d{4}-\d{2}-\d{2}(?:[ T]\d{2}:\d{2}:\d{2})?$/', $value)) {
                try {
                    return Carbon::parse($value)->locale('id')->translatedFormat('d F Y');
                } catch (\Throwable $_) {
                    
                }
            }
        }

        return $value;
    }
}
