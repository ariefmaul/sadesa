<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_surats', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('kode')->unique();

            $table->text('deskripsi')->nullable();

            $table->string('template')->nullable();

            $table->boolean('aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_surats');
    }
};
