<?php

namespace App\Services;

use App\Models\PengajuanSurat;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratGeneratorService
{
    public function generate(PengajuanSurat $pengajuan): void
    {
        $pengajuan->load([
            'jenisSurat',
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 1. Generate QR Token
        |--------------------------------------------------------------------------
        */

        if (! $pengajuan->qr_token) {
            $pengajuan->qr_token = Str::uuid()->toString();
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Folder Penyimpanan
        |--------------------------------------------------------------------------
        */

        $folder = 'surat/'.$pengajuan->id;

        Storage::disk('public')->makeDirectory($folder);

        /*
        |--------------------------------------------------------------------------
        | 3. Generate QR Code
        |--------------------------------------------------------------------------
        */

        $qrUrl = route('surat.validasi', [
            'token' => $pengajuan->qr_token,
        ]);

        $qrResult = Builder::create()
            ->writer(new PngWriter)
            ->data($qrUrl)
            ->size(300)
            ->margin(10)
            ->build();

        $qrPath = storage_path(
            'app/public/'.$folder.'/qr.png'
        );

        $qrResult->saveToFile($qrPath);

        /*
        |--------------------------------------------------------------------------
        | 4. Template Word
        |--------------------------------------------------------------------------
        */

        $templatePath = storage_path(
            'app/public/'.$pengajuan->jenisSurat->template
        );

        if (! file_exists($templatePath)) {
            throw new \Exception(
                'Template surat tidak ditemukan: '.$templatePath
            );
        }

        $template = new TemplateProcessor($templatePath);

        /*
        |--------------------------------------------------------------------------
        | 5. Data Masyarakat
        |--------------------------------------------------------------------------
        */

        $user = $pengajuan->user;

        $data = $pengajuan->data_snapshot
            ?? $pengajuan->data_pengajuan
            ?? [];

        /*
        |--------------------------------------------------------------------------
        | 6. Data dasar
        |--------------------------------------------------------------------------
        */

        $variables = array_merge(
            [
                'nama' => $user->name ?? '',
                'nik' => $user->nik ?? '',
                'email' => $user->email ?? '',
                'jenis_kelamin' => $user->jenis_kelamin ?? '',
                'nomor_pengajuan' => $pengajuan->nomor_pengajuan,
                'tanggal_pengajuan' => now()->format('d-m-Y'),
            ],
            $data
        );

        /*
        |--------------------------------------------------------------------------
        | 7. Replace variable Word
        |--------------------------------------------------------------------------
        */

        foreach ($variables as $key => $value) {

            if (is_array($value)) {
                continue;
            }

            $template->setValue(
                $key,
                htmlspecialchars((string) $value)
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 8. QR Code ke Word
        |--------------------------------------------------------------------------
        */

        try {
            $template->setImageValue('qr_code', [
                'path' => $qrPath,
                'width' => 120,
                'height' => 120,
            ]);
        } catch (\Throwable $e) {
            // Template tidak memiliki ${qr_code}
        }

        /*
        |--------------------------------------------------------------------------
        | 9. Simpan DOCX
        |--------------------------------------------------------------------------
        */

        $wordFilename =
            'surat-'.
            $pengajuan->nomor_pengajuan.
            '.docx';

        $wordPath =
            storage_path(
                'app/public/'.$folder.'/'.$wordFilename
            );

        $template->saveAs($wordPath);

        /*
        |--------------------------------------------------------------------------
        | 10. Simpan informasi ke database
        |--------------------------------------------------------------------------
        */

        $pengajuan->dokumen_word =
            $folder.'/'.$wordFilename;

        $pengajuan->save();
    }
}
