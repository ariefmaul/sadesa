<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {

            try {
                $table->dropUnique(['kode']);
            } catch (Throwable $_) {

            }

            $table->unique(['desa_id', 'kode'], 'jenis_surats_desa_id_kode_unique');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_surats', function (Blueprint $table) {
            try {
                $table->dropUnique('jenis_surats_desa_id_kode_unique');
            } catch (Throwable $_) {
            }

            $table->unique('kode');
        });
    }
};
