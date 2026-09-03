<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (! Schema::hasColumn('pengajuan_surats', 'data_snapshot')) {
                $table->json('data_snapshot')->nullable()->after('data_pengajuan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_surats', 'data_snapshot')) {
                $table->dropColumn('data_snapshot');
            }
        });
    }
};
