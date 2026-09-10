<?php

namespace App\Notifications;

use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanDitolakNotification extends Notification
{
    use Queueable;

    public function __construct(public PengajuanSurat $pengajuan, public ?string $catatan = null)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $desa = $notifiable->desa()->first();
        $kecamatan = $desa?->kecamatan()->first();
        $kota = $kecamatan?->kota()->first();
        $provinsi = $kota?->provinsi()->first();

        $this->pengajuan->loadMissing(['jenisSurat', 'user.desa.kecamatan.kota.provinsi']);

        return (new MailMessage)
            ->subject('SADESA - Pengajuan Surat Anda Ditolak')
            ->greeting('Halo, '.$notifiable->name)
            ->line('Pengajuan surat Anda ditolak oleh Admin Desa.')
            ->line('Informasi wilayah:')
            ->line('Nama Desa: '.($desa?->nama ?? '-'))
            ->line('Kecamatan: '.($kecamatan?->nama ?? '-'))
            ->line('Kota/Kabupaten: '.($kota?->nama ?? '-'))
            ->line('Provinsi: '.($provinsi?->nama ?? '-'))
            ->line('Nomor Pengajuan: '.($this->pengajuan->nomor_pengajuan ?? '-'))
            ->line('Jenis Surat: '.($this->pengajuan->jenisSurat?->nama ?? '-'))
            ->line('Tanggal Pengajuan: '.($this->pengajuan->created_at?->translatedFormat('d F Y') ?? '-'))
            ->line('Status: Ditolak')
            ->line('Catatan Admin: '.($this->catatan ?? '-'))
            ->action('Lihat Detail Pengajuan', route('masyarakat.pengajuan.show', $this->pengajuan, true))
            ->salutation('SADESA\nSistem Administrasi Desa');
    }
}
