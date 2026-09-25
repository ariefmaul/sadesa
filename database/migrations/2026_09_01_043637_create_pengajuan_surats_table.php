<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('jenis_surat_id')
                ->constrained('jenis_surats')
                ->cascadeOnDelete();

            $table->string('nomor_pengajuan')->unique();

            $table->json('data_pengajuan');

            $table->enum('status', [
                'menunggu',
                'diproses',
                'disetujui',
                'ditolak',
                'dicetak',
            ])->default('menunggu');

            $table->text('catatan')->nullable();

            $table->timestamp('verified_at')->nullable();

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
