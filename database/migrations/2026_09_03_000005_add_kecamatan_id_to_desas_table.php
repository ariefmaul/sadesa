<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('desas', function (Blueprint $table) {
            if (! Schema::hasColumn('desas', 'kecamatan_id')) {
                $table->foreignId('kecamatan_id')->nullable()->after('kode');
            }
        });
    }

    public function down(): void
    {
        Schema::table('desas', function (Blueprint $table) {
            if (Schema::hasColumn('desas', 'kecamatan_id')) {
                $table->dropForeign(['kecamatan_id']);
                $table->dropColumn('kecamatan_id');
            }
        });
    }
};
