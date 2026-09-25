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

        if (! $pengajuan->qr_token) {
            $pengajuan->qr_token = Str::uuid()->toString();
        }

        $folder = 'surat/'.$pengajuan->id;

        Storage::disk('public')->makeDirectory($folder);

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

        $templatePath = storage_path(
            'app/public/'.$pengajuan->jenisSurat->template
        );

        if (! file_exists($templatePath)) {
            throw new \Exception(
                'Template surat tidak ditemukan: '.$templatePath
            );
        }

        $template = new TemplateProcessor($templatePath);

        $user = $pengajuan->user;

        $data = $pengajuan->data_snapshot
            ?? $pengajuan->data_pengajuan
            ?? [];

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

        foreach ($variables as $key => $value) {

            if (is_array($value)) {
                continue;
            }

            $template->setValue(
                $key,
                htmlspecialchars((string) $value)
            );
        }

        try {
            $template->setImageValue('qr_code', [
                'path' => $qrPath,
                'width' => 120,
                'height' => 120,
            ]);
        } catch (\Throwable $e) {

        }

        $wordFilename =
            'surat-'.
            $pengajuan->nomor_pengajuan.
            '.docx';

        $wordPath =
            storage_path(
                'app/public/'.$folder.'/'.$wordFilename
            );

        $template->saveAs($wordPath);

        $pengajuan->dokumen_word =
            $folder.'/'.$wordFilename;

        $pengajuan->save();
    }
}
