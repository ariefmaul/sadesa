<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MasyarakatSeeder extends Seeder
{
    public function run(): void
    {
        $desa = Desa::where('kode', '000001')->first() ?? Desa::first();

        if (! $desa) {
            return;
        }

        $user = User::updateOrCreate(
            ['email' => 'masyarakat@sadesa.test'],
            [
                'name' => 'Masyarakat Contoh',
                'nik' => '3200000000000003',
                'jenis_kelamin' => 'P',
                'desa_id' => $desa->id,
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'status_verifikasi' => 'menunggu',
            ]
        );

        $user->profilMasyarakat()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nomor_kk' => '3200000000000100',
                'tempat_lahir' => 'Tasikmalaya',
                'tanggal_lahir' => '2005-01-10',
                'alamat' => 'Jl. Mawar No. 1',
                'rt' => '001',
                'rw' => '002',
                'dusun' => 'Dusun Contoh',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan' => 'Pelajar',
                'kewarganegaraan' => 'WNI',
                'no_hp' => '081234567890',
            ]
        );
    }
}
