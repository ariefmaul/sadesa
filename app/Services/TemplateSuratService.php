<?php

namespace App\Services;

use App\Models\JenisSurat;
use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;
use RuntimeException;
use Symfony\Component\Process\Process;

class TemplateSuratService
{
    public function __construct(private readonly SuratFieldResolver $resolver) {}

    /**
     * Generate a DOCX for a pengajuan. You can pass extras like:
     * ['nomor_dokumen' => '...', 'tanggal_surat' => '...', 'qr_file' => 'path/to/qr.png']
     */
    public function generateDocx(PengajuanSurat $pengajuan, array $extras = []): string
    {
        $pengajuan->loadMissing(['jenisSurat', 'dokumen']);

        abort_if(! $pengajuan->jenisSurat->template, 422, 'Template DOCX belum tersedia.');

        $templatePath = Storage::disk('public')->path($pengajuan->jenisSurat->template);

        Log::info('TemplateSuratService: using template', ['template' => $templatePath]);

        if (! file_exists($templatePath)) {
            throw new RuntimeException('Template DOCX tidak ditemukan: '.$templatePath);
        }

        if (! is_readable($templatePath)) {
            throw new RuntimeException('Template DOCX tidak dapat dibaca: '.$templatePath);
        }

        try {
            $processor = new TemplateProcessor($templatePath);
        } catch (\Throwable $e) {
            Log::error('TemplateSuratService: gagal membuat TemplateProcessor', ['error' => $e->getMessage()]);
            throw new RuntimeException('Gagal membuka template DOCX: '.$e->getMessage(), 0, $e);
        }

        // Merge automatic template data with extras (extras take precedence)
        $data = array_merge($this->resolver->templateData($pengajuan), $extras);

        // Get variables present in template
        try {
            $templateVariables = $processor->getVariables();
        } catch (\Throwable $e) {
            Log::warning('TemplateSuratService: getVariables failed', ['error' => $e->getMessage()]);
            $templateVariables = [];
        }

        // Required SADESA debug logs
        Log::info('SADESA TEMPLATE DATA', [
            'pengajuan_id' => $pengajuan->id,
            'data_keys' => array_keys($data),
        ]);

        Log::info('SADESA TEMPLATE VARIABLES', ['variables' => $templateVariables]);

        Log::info('TemplateSuratService: data to inject', ['keys' => array_keys($data)]);

        // Build mapping of normalized -> raw variable names from template variables
        $normalizedToRaw = [];
        foreach ($templateVariables as $rawVar) {
            $norm = strtolower(preg_replace('/\s+/', '_', trim($rawVar)));
            // prefer preserving rawVar as-is; allow multiple raw for same norm
            if (! isset($normalizedToRaw[$norm])) {
                $normalizedToRaw[$norm] = $rawVar;
            }
        }

        // Also extract placeholders directly from document.xml as fallback (normalized)
        $extracted = $this->extractPlaceholders($pengajuan->jenisSurat->template);
        Log::info('TemplateSuratService: extracted placeholders (normalized)', ['extracted' => $extracted]);

        // merge extracted into mapping if not present
        foreach ($extracted as $norm) {
            if (! isset($normalizedToRaw[$norm])) {
                // guess raw as the normalized form (no spaces)
                $normalizedToRaw[$norm] = $norm;
            }
        }

        // Log SADESA SURAT DATA including snapshot and pengajuan data for validation
        Log::info('SADESA SURAT DATA', [
            'pengajuan_id' => $pengajuan->id,
            'template_variables' => $templateVariables,
            'data_pengajuan' => $pengajuan->data_pengajuan,
            'data_snapshot' => $pengajuan->data_snapshot,
            'template_data' => $data,
        ]);

        // Validate that required template variables have data available
        $requiredNorms = array_unique(array_merge(array_keys($normalizedToRaw), $extracted));
        $missing = [];
        // build normalized keys from data
        $dataNormKeys = array_map(fn ($k) => strtolower(preg_replace('/\s+/', '_', trim($k))), array_keys($data));

        foreach ($requiredNorms as $req) {
            // skip nomor_surat if expected to be provided via extras
            if ($req === 'nomor_surat' && array_key_exists('nomor_surat', $data)) {
                continue;
            }

            if (! in_array($req, $dataNormKeys, true)) {
                $missing[] = $req;
            }
        }

        if (! empty($missing)) {
            Log::error('TemplateSuratService: missing template data', ['missing' => $missing]);
            throw new RuntimeException('Field template ['.implode(',', $missing).'] tidak memiliki data.');
        }

        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $normKey = strtolower(preg_replace('/\s+/', '_', trim($key)));

            // image placeholders
            if (in_array($normKey, ['qr_code', 'qr_file'], true)) {
                $abs = Storage::disk('public')->path($value);
                if (file_exists($abs)) {
                    $raw = $normalizedToRaw[$normKey] ?? $normKey;
                    try {
                        $processor->setImageValue($raw, [
                            'path' => $abs,
                            'width' => 150,
                            'height' => 150,
                            'ratio' => false,
                        ]);
                    } catch (\Throwable $e) {
                        Log::error('TemplateSuratService: setImageValue exception', ['placeholder' => $raw, 'error' => $e->getMessage()]);
                        throw $e;
                    }
                } else {
                    Log::warning('TemplateSuratService: image file for placeholder not found', ['placeholder' => $key, 'path' => $abs]);
                }

                continue;
            }

            if (isset($normalizedToRaw[$normKey])) {
                $rawVar = $normalizedToRaw[$normKey];
                try {
                    $processor->setValue($rawVar, (string) $value);
                    Log::info('TemplateSuratService: replaced placeholder', ['raw' => $rawVar, 'value_key' => $key]);
                } catch (\Throwable $e) {
                    Log::error('TemplateSuratService: setValue exception', ['placeholder' => $rawVar, 'error' => $e->getMessage()]);
                    throw $e;
                }
            } else {
                Log::debug('TemplateSuratService: no matching template variable for data key', ['data_key' => $key, 'normalized' => $normKey]);
            }
        }

        $directory = 'dokumen';

        Storage::disk('public')->makeDirectory($directory);

        $absoluteDirectory = Storage::disk('public')->path($directory);

        if (! is_dir($absoluteDirectory)) {
            throw new RuntimeException(
                'Folder dokumen tidak dapat dibuat: '.$absoluteDirectory
            );
        }

        $filename = $directory.'/'.
            Str::slug($pengajuan->nomor_pengajuan).
            '.docx';

        $absolutePath = Storage::disk('public')->path($filename);

        // Quick permission/writeability check: can we create a temp file in directory?
        try {
            $tmpTest = tempnam($absoluteDirectory, 'writetest_');
            if ($tmpTest === false) {
                Log::error('TemplateSuratService: unable to create temp file in dokumen directory', ['dir' => $absoluteDirectory]);
                throw new RuntimeException('Tidak dapat membuat file pada folder dokumen: '.$absoluteDirectory);
            }
            // tempnam may create file elsewhere depending on system, move it to the directory if needed
            if (! str_starts_with($tmpTest, $absoluteDirectory)) {
                // try creating a file directly in directory
                $tmpTest2 = $absoluteDirectory.DIRECTORY_SEPARATOR.'writetest_'.Str::random(6);
                $res = @file_put_contents($tmpTest2, 'ok');
                if ($res === false) {
                    Log::error('TemplateSuratService: file_put_contents test failed', ['path' => $tmpTest2]);
                    throw new RuntimeException('Tidak dapat menulis ke folder dokumen: '.$absoluteDirectory);
                }
                @unlink($tmpTest2);
            } else {
                @unlink($tmpTest);
            }
        } catch (\Throwable $e) {
            Log::error('TemplateSuratService: write test failed', ['dir' => $absoluteDirectory, 'error' => $e->getMessage()]);
            throw $e;
        }

        // Log debug before save as required
        Log::info('SADESA DOCX DEBUG BEFORE SAVE', [
            'template_relative' => $pengajuan->jenisSurat->template,
            'template_absolute' => $templatePath,
            'template_exists' => file_exists($templatePath),
            'template_readable' => is_readable($templatePath),
            'output_relative' => $filename,
            'output_absolute' => $absolutePath,
            'output_directory' => $absoluteDirectory,
            'output_directory_exists' => is_dir($absoluteDirectory),
        ]);

        // Attempt to save DOCX robustly: save to system temp then move into place
        $saved = false;
        $errors = [];

        // First try saving directly to destination (fast path)
        try {
            $processor->saveAs($absolutePath);
            if (file_exists($absolutePath) && filesize($absolutePath) > 0) {
                $saved = true;
                $size = filesize($absolutePath);
                Log::info('TemplateSuratService: DOCX saved (direct)', ['path' => $absolutePath, 'size' => $size]);
            } else {
                $errors[] = 'Direct save produced missing/empty file';
                Log::warning('TemplateSuratService: direct save produced missing or empty file', ['path' => $absolutePath]);
            }
        } catch (\Throwable $e) {
            $errors[] = 'Direct save exception: '.$e->getMessage();
            Log::warning('TemplateSuratService: direct save exception', ['path' => $absolutePath, 'error' => $e->getMessage()]);
        }

        // If direct save failed or produced empty file, try save to system temp and move
        if (! $saved) {
            $tmp = tempnam(sys_get_temp_dir(), 'sadesa_docx_');
            if ($tmp === false) {
                $errors[] = 'tempnam failed';
                Log::error('TemplateSuratService: tempnam failed for system temp dir', ['dir' => sys_get_temp_dir()]);
            } else {
                // ensure tmp has .docx extension (some tools rely on it)
                $tmpDocx = $tmp.'.docx';
                try {
                    // attempt save to tmp file
                    $processor->saveAs($tmpDocx);
                    if (file_exists($tmpDocx) && filesize($tmpDocx) > 0) {
                        // remove existing target if present and zero-length
                        if (file_exists($absolutePath) && filesize($absolutePath) === 0) {
                            @unlink($absolutePath);
                        }

                        // move into place (rename is atomic on same filesystem)
                        if (@rename($tmpDocx, $absolutePath) === false) {
                            // fallback to copy
                            if (@copy($tmpDocx, $absolutePath) === false) {
                                $errors[] = 'rename and copy failed when moving tmp file';
                                Log::error('TemplateSuratService: failed to move tmp docx into place', ['tmp' => $tmpDocx, 'dest' => $absolutePath]);
                            } else {
                                @unlink($tmpDocx);
                                $saved = true;
                            }
                        } else {
                            $saved = true;
                        }

                        if ($saved) {
                            $size = filesize($absolutePath);
                            Log::info('TemplateSuratService: DOCX saved via tmp move', ['path' => $absolutePath, 'size' => $size]);
                        }
                    } else {
                        $errors[] = 'tmp save produced missing/empty file';
                        Log::warning('TemplateSuratService: tmp save produced missing or empty file', ['tmp' => $tmpDocx]);
                        @unlink($tmpDocx);
                    }
                } catch (\Throwable $e) {
                    $errors[] = 'tmp save exception: '.$e->getMessage();
                    Log::error('TemplateSuratService: exception saving to tmp', ['tmp' => $tmpDocx, 'error' => $e->getMessage()]);
                    @unlink($tmpDocx);
                }
            }
        }

        if (! $saved) {
            // enumerate directory for diagnostics
            $files = @scandir($absoluteDirectory);
            Log::error('TemplateSuratService: DOCX not saved after fallback attempts', ['path' => $absolutePath, 'dir' => $absoluteDirectory, 'files' => $files, 'errors' => $errors]);
            throw new RuntimeException('DOCX berhasil diproses tetapi file tidak dapat disimpan: '.$absolutePath.'. Errors: '.implode(' | ', $errors));
        }

        // Clear cache and perform strict checks as requested
        clearstatcache(true, $absolutePath);

        Log::info('SADESA DOCX DEBUG AFTER SAVE', [
            'output_absolute' => $absolutePath,
            'exists' => file_exists($absolutePath),
            'is_file' => is_file($absolutePath),
            'readable' => is_readable($absolutePath),
            'size' => file_exists($absolutePath) ? filesize($absolutePath) : null,
        ]);

        if (! file_exists($absolutePath)) {
            throw new RuntimeException('DEBUG: PHPWord TIDAK menghasilkan file DOCX. Path: '.$absolutePath);
        }

        if (! is_file($absolutePath)) {
            throw new RuntimeException('DEBUG: Path DOCX bukan file: '.$absolutePath);
        }

        $size = filesize($absolutePath);

        if ($size === false || $size <= 0) {
            throw new RuntimeException('DEBUG: File DOCX kosong atau tidak dapat dibaca. Path: '.$absolutePath);
        }

        return $filename;
    }

    public function convertDocxToPdf(string $docxRelativePath): string
    {
        $libre = config('services.libreoffice.path');

        if (! $libre) {
            throw new RuntimeException(
                'LIBREOFFICE_PATH belum dikonfigurasi pada file .env.'
            );
        }

        $libre = str_replace('/', DIRECTORY_SEPARATOR, $libre);

        if (! file_exists($libre)) {
            throw new RuntimeException(
                'Executable LibreOffice tidak ditemukan: '.$libre
            );
        }

        $disk = Storage::disk('public');

        $absDocx = $disk->path($docxRelativePath);

        if (! file_exists($absDocx)) {
            throw new RuntimeException(
                'File DOCX tidak ditemukan: '.$absDocx
            );
        }

        $outDir = dirname($absDocx);

        if (! is_dir($outDir)) {
            mkdir($outDir, 0775, true);
        }

        $pdfAbs = preg_replace(
            '/\.docx$/i',
            '.pdf',
            $absDocx
        );

        /*
        |--------------------------------------------------------------------------
        | Temporary LibreOffice profile
        |--------------------------------------------------------------------------
        */

        $profileDir = storage_path(
            'app/libreoffice-profile/'.Str::uuid()
        );

        if (! is_dir($profileDir)) {
            mkdir($profileDir, 0775, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Jalankan LibreOffice
        |--------------------------------------------------------------------------
        */

        $libreDir = dirname($libre);

        $command = [
            $libre,
            '--headless',
            '--invisible',
            '--nodefault',
            '--nofirststartwizard',
            '-env:UserInstallation=file:///'.str_replace('\\', '/', $profileDir),
            '--convert-to',
            'pdf:writer_pdf_Export',
            '--outdir',
            $outDir,
            $absDocx,
        ];

        // Provide a sanitized environment for the process (helps on Windows)
        $env = [
            'HOME' => storage_path('app'),
            'TMP' => sys_get_temp_dir(),
            'TEMP' => sys_get_temp_dir(),
        ];

        if (getenv('USERPROFILE')) {
            $env['USERPROFILE'] = getenv('USERPROFILE');
        }

        Log::info('TemplateSuratService: launching LibreOffice', ['command' => $command, 'cwd' => $libreDir, 'env_keys' => array_keys($env)]);

        $process = new Process($command, $libreDir, $env, null, 180);

        try {
            $process->run();
        } catch (\Throwable $e) {
            Log::error('TemplateSuratService: LibreOffice process failed to start', ['error' => $e->getMessage()]);
            throw new RuntimeException('LibreOffice gagal dijalankan: '.$e->getMessage());
        }

        $stdout = trim($process->getOutput());
        $stderr = trim($process->getErrorOutput());

        Log::info('TemplateSuratService: LibreOffice finished', ['exit_code' => $process->getExitCode(), 'stdout' => $stdout, 'stderr' => $stderr]);

        /*
        |--------------------------------------------------------------------------
        | Debug jika gagal
        |--------------------------------------------------------------------------
        */

        if (! file_exists($pdfAbs)) {

            throw new RuntimeException(
                "LibreOffice tidak menghasilkan file PDF.\n\n".
                "DOCX: {$absDocx}\n".
                "Output folder: {$outDir}\n".
                "LibreOffice: {$libre}\n".
                "Exit code: {$process->getExitCode()}\n".
                "STDOUT: {$stdout}\n".
                "STDERR: {$stderr}"
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Convert absolute path → relative storage path
        |--------------------------------------------------------------------------
        */

        $publicRoot = $disk->path('');

        $relative = str_replace(
            '\\',
            '/',
            str_replace(
                str_replace('\\', '/', $publicRoot),
                '',
                str_replace('\\', '/', $pdfAbs)
            )
        );

        return ltrim($relative, '/');
    }

    /**
     * Extract placeholders from a DOCX template file stored on public disk.
     * Returns array of placeholder names without ${}
     */
    public function extractPlaceholders(string $docxRelativePath): array
    {
        $abs = Storage::disk('public')->path($docxRelativePath);

        if (! file_exists($abs)) {
            return [];
        }

        $placeholders = [];

        $zip = new \ZipArchive;
        if ($zip->open($abs) === true) {
            $index = $zip->locateName('word/document.xml');
            if ($index !== false) {
                $xml = $zip->getFromIndex($index);

                // find ${placeholder} patterns
                if (preg_match_all('/\$\{([a-zA-Z0-9_\s]+)\}/', $xml, $matches)) {
                    foreach ($matches[1] as $m) {
                        $name = trim($m);
                        // normalize spaces to underscore and lowercase for detection
                        $normalized = strtolower(preg_replace('/\s+/', '_', $name));
                        $placeholders[] = $normalized;
                    }
                }
            }

            $zip->close();
        }

        return array_values(array_unique($placeholders));
    }

    /**
     * Validate placeholders against known fields (jenis surat fields and profile keys)
     * Returns array of unknown placeholders.
     */
    public function validatePlaceholders(array $placeholders, ?JenisSurat $jenisSurat = null, ?User $user = null): array
    {
        $known = [];

        // built-in profile keys from resolver
        $auto = $this->resolver->automaticData($user ?? new User);

        $flatten = function ($arr, $prefix = '') use (&$flatten) {
            $out = [];
            foreach ($arr as $k => $v) {
                if (is_array($v)) {
                    $out = array_merge($out, $flatten($v, $prefix.$k.'.'));
                } else {
                    $out[] = $k;
                }
            }

            return $out;
        };

        $profileKeys = $flatten($auto);

        foreach ($profileKeys as $k) {
            $known[] = $k;
            // also add alias: if key ends with _desa or nama_desa, add 'desa'
            if (str_ends_with($k, 'nama_desa')) {
                $known[] = 'desa';
            }
        }

        // jenis surat fields
        if ($jenisSurat) {
            foreach ($jenisSurat->fields as $f) {
                $known[] = $f->fieldName();
            }
        }

        $known = array_unique($known);

        $unknown = [];
        foreach ($placeholders as $p) {
            if (! in_array($p, $known, true)) {
                $unknown[] = $p;
            }
        }

        return $unknown;
    }
}
