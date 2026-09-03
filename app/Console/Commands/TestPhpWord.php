<?php

namespace App\Console\Commands;

use App\Models\JenisSurat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class TestPhpWord extends Command
{
    protected $signature = 'sadesa:test-phpword {--template=}';

    protected $description = 'Test PHPWord TemplateProcessor: save a small DOCX into storage/public/dokumen';

    public function handle()
    {
        $relative = $this->option('template');

        if (! $relative) {
            $jenis = JenisSurat::whereNotNull('template')->first();
            if (! $jenis) {
                $this->error('Tidak ada JenisSurat dengan template. Silakan upload satu template DOCX terlebih dahulu.');
                return 1;
            }
            $relative = $jenis->template;
        }

        $disk = Storage::disk('public');
        $templatePath = $disk->path($relative);

        $this->info('Using template: '.$templatePath);

        if (! file_exists($templatePath)) {
            $this->error('Template file tidak ditemukan: '.$templatePath);
            return 1;
        }

        if (! is_readable($templatePath)) {
            $this->error('Template tidak dapat dibaca: '.$templatePath);
            return 1;
        }

        try {
            $processor = new TemplateProcessor($templatePath);
        } catch (\Throwable $e) {
            $this->error('Gagal membuka template: '.$e->getMessage());
            Log::error('sadesa:test-phpword failed to open template', ['error' => $e->getMessage()]);
            return 1;
        }

        $outputDir = $disk->path('dokumen');
        if (! is_dir($outputDir)) {
            $disk->makeDirectory('dokumen');
        }

        $out = $outputDir.DIRECTORY_SEPARATOR.'test-sadesa.docx';

        try {
            $processor->setValue('nama', 'TEST SADESA');
            $processor->saveAs($out);
        } catch (\Throwable $e) {
            $this->error('Gagal menyimpan test DOCX: '.$e->getMessage());
            Log::error('sadesa:test-phpword save failed', ['error' => $e->getMessage()]);
            return 1;
        }

        clearstatcache(true, $out);

        if (! file_exists($out)) {
            $this->error('Test DOCX tidak ditemukan setelah save: '.$out);
            return 1;
        }

        $size = filesize($out);
        if ($size === false || $size <= 0) {
            $this->error('Test DOCX kosong atau tidak dapat dibaca: '.$out);
            return 1;
        }

        $this->info('Test DOCX berhasil dibuat: '.$out.' ('.number_format($size).' bytes)');
        return 0;
    }
}
