<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'super_admin',
                'admin_desa',
                'masyarakat',
                'mesin'
            ) NOT NULL DEFAULT 'masyarakat'
        ");
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement("
            ALTER TABLE users
            MODIFY role ENUM(
                'super_admin',
                'admin_desa',
                'masyarakat'
            ) NOT NULL DEFAULT 'masyarakat'
        ");
    }
};
