<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'nik')) {
                $table->string('nik', 16)->nullable()->unique()->after('name');
            }

            if (! Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('nik');
            }

            if (! Schema::hasColumn('users', 'desa_id')) {
                $table->foreignId('desa_id')->nullable()->after('jenis_kelamin');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'desa_id')) {
                $table->dropColumn('desa_id');
            }

            if (Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->dropColumn('jenis_kelamin');
            }

            if (Schema::hasColumn('users', 'nik')) {
                $table->dropColumn('nik');
            }
        });
    }
};
