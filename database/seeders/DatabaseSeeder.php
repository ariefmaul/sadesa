<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    
    public function run(): void
    {
        $this->call([
            DesaSeeder::class,
            SuperAdminSeeder::class,
            AdminDesaSeeder::class,
            MasyarakatSeeder::class,
            MesinSeeder::class,
        ]);
    }
}
