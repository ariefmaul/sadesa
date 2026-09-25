<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pengajuan_surat_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nomor_dokumen')->unique();

            $table->string('file');

            $table->string('qr_token')->unique();

            $table->enum('status', [
                'tersedia',
                'dicetak',
            ])->default('tersedia');

            $table->timestamp('dicetak_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
