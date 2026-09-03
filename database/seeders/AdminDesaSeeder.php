<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminDesaSeeder extends Seeder
{
    public function run(): void
    {
        $desa = Desa::where('kode', '000001')->first() ?? Desa::first();

        if (! $desa) {
            return;
        }

        User::updateOrCreate(
            ['email' => 'admindesa@sadesa.test'],
            [
                'name' => 'Admin Desa Contoh',
                'nik' => '3200000000000002',
                'jenis_kelamin' => 'L',
                'desa_id' => $desa->id,
                'password' => Hash::make('password'),
                'role' => 'admin_desa',
                'status_verifikasi' => 'disetujui',
            ]
        );
    }
}
