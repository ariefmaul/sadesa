<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            if (! Schema::hasColumn('dokumens', 'dokumen_pdf')) {
                $table->string('dokumen_pdf')->nullable()->after('file');
            }

            if (! Schema::hasColumn('dokumens', 'qr_file')) {
                $table->string('qr_file')->nullable()->after('qr_token');
            }
        });
    }

    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            if (Schema::hasColumn('dokumens', 'dokumen_pdf')) {
                $table->dropColumn('dokumen_pdf');
            }

            if (Schema::hasColumn('dokumens', 'qr_file')) {
                $table->dropColumn('qr_file');
            }
        });
    }
};
