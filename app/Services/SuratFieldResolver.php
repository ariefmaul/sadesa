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
                // combined field commonly used in templates
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

        // If jenis surat has no configured fields, fall back to full automatic data
        // flattened so templates can still use profile data without requiring form fields.
        if ($jenisSurat->fields->isEmpty()) {
            // flatten automatic into top-level keys, preferring user/profile keys
            $flat = [];
            // user
            foreach ($automatic['user'] ?? [] as $k => $v) {
                $flat[$k] = $v;
            }
            // profil
            foreach ($automatic['profil'] ?? [] as $k => $v) {
                if (! isset($flat[$k]) || $flat[$k] === null || $flat[$k] === '') {
                    $flat[$k] = $v;
                }
            }
            // desa
            foreach ($automatic['desa'] ?? [] as $k => $v) {
                if (! isset($flat[$k]) || $flat[$k] === null || $flat[$k] === '') {
                    $flat[$k] = $v;
                }
            }

            // merge pengajuan data (overrides profile if provided)
            return array_merge($flat, $dataPengajuan ?? []);
        }

        // First, include all automatic user/profile/desa data into snapshot
        // so snapshot contains full user profile by default.
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

        // Build snapshot per-field honoring source_data (pengajuan overrides profile where specified)
        foreach ($jenisSurat->fields as $field) {
            $name = $field->fieldName();
            $source = $field->sourceData();

            // normalize common source names
            $sourceNormalized = match (strtolower($source)) {
                'profile' => 'profil',
                'profil' => 'profil',
                'user' => 'user',
                'desa' => 'desa',
                default => $source,
            };

            if ($sourceNormalized === 'pengajuan') {
                // pengajuan fields override profile values for that field
                $snapshot[$name] = $dataPengajuan[$name] ?? null;

                continue;
            }

            // for profile/user/desa sources, if the flattened snapshot already contains a value,
            // keep it. If not, try to fetch specifically.
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
                // keep existing flattened value
                $snapshot[$name] = $existing;
            }
        }

        // Debug log snapshot composition
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

        // Use existing snapshot if present, otherwise generate one
        $snapshot = $pengajuan->data_snapshot ?? $this->snapshotFor(
            $pengajuan->jenisSurat,
            $pengajuan->user,
            $pengajuan->data_pengajuan ?? []
        );

        // Template data should primarily come from snapshot, then overlay any pengajuan inputs
        $data = array_merge($snapshot, $pengajuan->data_pengajuan ?? []);

        // Normalize date-like values (submitted as Y-m-d from forms) into human-readable
        // format expected by templates (d F Y) so Word receives tanggal-bulan-tahun order.
        foreach ($data as $key => $val) {
            $formatted = $this->formatDate($val);
            if ($formatted !== $val) {
                $data[$key] = $formatted;
            }
        }

        // Debug log
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
            return $value->translatedFormat('d F Y');
        }

        if (is_string($value)) {
            // detect ISO date strings like YYYY-MM-DD or full datetime and format
            if (preg_match('/^\d{4}-\d{2}-\d{2}(?:[ T]\d{2}:\d{2}:\d{2})?$/', $value)) {
                try {
                    return Carbon::parse($value)->translatedFormat('d F Y');
                } catch (\Throwable $_) {
                    // fallback to original string
                }
            }
        }

        return $value;
    }
}
