<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        Desa::updateOrCreate(
            ['nama' => 'Desa Contoh'],
            ['kode' => '000001']
        );

        Desa::updateOrCreate(
            ['nama' => 'Desa Sukamaju'],
            ['kode' => '000002']
        );

        Desa::updateOrCreate(
            ['nama' => 'Desa Mekarjaya'],
            ['kode' => '000003']
        );
    }
}
