<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {
            // Drop global unique on kode and replace with composite unique (desa_id, kode)
            try {
                $table->dropUnique(['kode']);
            } catch (\Throwable $_) {
                // ignore if not exists
            }

            // create composite unique index
            $table->unique(['desa_id', 'kode'], 'jenis_surats_desa_id_kode_unique');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {
            try {
                $table->dropUnique('jenis_surats_desa_id_kode_unique');
            } catch (\Throwable $_) {
            }

            // restore global unique on kode
            $table->unique('kode');
        });
    }
};
