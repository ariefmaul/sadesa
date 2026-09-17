<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement(
            "ALTER TABLE `surat_fields` MODIFY COLUMN `type` ENUM('text', 'textarea', 'date', 'number', 'email', 'select') NOT NULL DEFAULT 'text'"
        );
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement(
            "ALTER TABLE `surat_fields` MODIFY COLUMN `type` ENUM('text', 'textarea', 'date', 'number', 'email') NOT NULL DEFAULT 'text'"
        );
    }
};
