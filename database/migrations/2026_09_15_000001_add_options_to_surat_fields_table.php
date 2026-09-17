<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_fields', function (Blueprint $table) {
            if (! Schema::hasColumn('surat_fields', 'options')) {
                $table->json('options')->nullable()->after('wajib');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat_fields', function (Blueprint $table) {
            if (Schema::hasColumn('surat_fields', 'options')) {
                $table->dropColumn('options');
            }
        });
    }
};
