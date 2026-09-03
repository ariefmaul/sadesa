<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_fields', function (Blueprint $table) {
            if (! Schema::hasColumn('surat_fields', 'nama_field')) {
                $table->string('nama_field')->nullable()->after('jenis_surat_id');
            }

            if (! Schema::hasColumn('surat_fields', 'sumber_data')) {
                $table->enum('sumber_data', ['user', 'profil', 'desa', 'pengajuan'])
                    ->default('pengajuan')
                    ->after('label');
            }

            if (! Schema::hasColumn('surat_fields', 'tipe')) {
                $table->enum('tipe', ['text', 'textarea', 'date', 'number', 'email', 'select'])
                    ->default('text')
                    ->after('sumber_data');
            }

            if (! Schema::hasColumn('surat_fields', 'wajib')) {
                $table->boolean('wajib')->default(true)->after('tipe');
            }
        });

        DB::table('surat_fields')
            ->whereNull('nama_field')
            ->update([
                'nama_field' => DB::raw('name'),
                'tipe' => DB::raw('type'),
                'wajib' => DB::raw('required'),
            ]);
    }

    public function down(): void
    {
        Schema::table('surat_fields', function (Blueprint $table) {
            if (Schema::hasColumn('surat_fields', 'wajib')) {
                $table->dropColumn('wajib');
            }

            if (Schema::hasColumn('surat_fields', 'tipe')) {
                $table->dropColumn('tipe');
            }

            if (Schema::hasColumn('surat_fields', 'sumber_data')) {
                $table->dropColumn('sumber_data');
            }

            if (Schema::hasColumn('surat_fields', 'nama_field')) {
                $table->dropColumn('nama_field');
            }
        });
    }
};
