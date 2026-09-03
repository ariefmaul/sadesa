<?php

namespace App\Services;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class QrCodeService
{
    /**
     * Membuat QR Code berdasarkan token.
     *
     * @return string Path file QR Code
     */
    public function generate(string $token): string
    {
        // URL yang akan dibuka ketika QR Code discan
        $url = route('surat.verifikasi', [
            'token' => $token,
        ]);

        $qrCode = new QrCode(
            data: $url,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 500,
            margin: 10,
            foregroundColor: new Color(0, 0, 0),
            backgroundColor: new Color(255, 255, 255),
        );

        $writer = new PngWriter;

        $result = $writer->write($qrCode);

        // Nama file
        $filename = 'qr-code/'.$token.'.png';

        // Simpan ke storage/app/public/qr-code/
        Storage::disk('public')->put(
            $filename,
            $result->getString()
        );

        return $filename;
    }
}
