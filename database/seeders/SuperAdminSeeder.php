<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'superadmin@sadesa.test',
            ],
            [
                'name' => 'Super Admin SADESA',
                'nik' => '3200000000000001',
                'jenis_kelamin' => 'L',
                'desa_id' => null,
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'status_verifikasi' => 'disetujui',
            ]
        );
    }
}
