<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->string('qr_token', 100)->nullable()->unique()->after('status');
            $table->string('dokumen_word')->nullable()->after('qr_token');
            $table->string('dokumen_pdf')->nullable()->after('dokumen_word');
            $table->timestamp('disetujui_at')->nullable()->after('dokumen_pdf');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'qr_token',
                'dokumen_word',
                'dokumen_pdf',
                'disetujui_at',
            ]);
        });
    }
};
