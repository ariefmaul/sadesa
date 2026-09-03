<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jenis_surat_id')
                ->constrained('jenis_surats')
                ->cascadeOnDelete();

            $table->string('label');

            $table->string('name');

            $table->enum('type', [
                'text',
                'textarea',
                'date',
                'number',
                'email',
            ])->default('text');

            $table->boolean('required')
                ->default(true);

            $table->integer('urutan')
                ->default(0);

            $table->timestamps();

            $table->unique([
                'jenis_surat_id',
                'name',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_fields');
    }
};
