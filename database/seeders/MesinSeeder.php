<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MesinSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'mesin@sadesa.test',
            ],
            [
                'name' => 'Mesin Cetak SADESA',
                'nik' => '0000000000000000',
                'jenis_kelamin' => 'L',
                'desa_id' => null,
                'password' => Hash::make('password'),
                'role' => 'mesin',
                'status_verifikasi' => 'disetujui',
            ]
        );
    }
}
