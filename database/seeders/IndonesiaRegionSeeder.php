<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class IndonesiaRegionSeeder extends Seeder
{
    
    public function run()
    {
        $base = 'https://emsifa.github.io/api-wilayah-indonesia/api';

        $this->command->info('Fetching provinces...');
        $provinces = Http::get("{$base}/provinces.json")->json() ?? [];

        foreach ($provinces as $prov) {
            $this->command->info("Seeding provinsi: {$prov['name']} ({$prov['id']})");

            DB::table('provinsis')->updateOrInsert(
                ['id' => $prov['id']],
                ['id' => $prov['id'], 'nama' => $prov['name']]
            );

            
            $regUrl = "{$base}/regencies/{$prov['id']}.json";
            $regencies = Http::get($regUrl)->json() ?? [];

            foreach ($regencies as $reg) {
                $this->command->info("  Seeding kota/kab: {$reg['name']} ({$reg['id']})");

                DB::table('kotas')->updateOrInsert(
                    ['id' => $reg['id']],
                    ['id' => $reg['id'], 'provinsi_id' => $prov['id'], 'nama' => $reg['name']]
                );

                
                $distUrl = "{$base}/districts/{$reg['id']}.json";
                $districts = Http::get($distUrl)->json() ?? [];

                foreach ($districts as $dist) {
                    DB::table('kecamatans')->updateOrInsert(
                        ['id' => $dist['id']],
                        ['id' => $dist['id'], 'kota_id' => $reg['id'], 'nama' => $dist['name']]
                    );

                    
                    $villUrl = "{$base}/villages/{$dist['id']}.json";
                    $villages = Http::get($villUrl)->json() ?? [];

                    foreach ($villages as $village) {
                        DB::table('desas')->updateOrInsert(
                            ['id' => $village['id']],
                            ['id' => $village['id'], 'kecamatan_id' => $dist['id'], 'nama' => $village['name']]
                        );
                    }
                }
            }
        }

        $this->command->info('Indonesia region seeding completed.');
    }
}
