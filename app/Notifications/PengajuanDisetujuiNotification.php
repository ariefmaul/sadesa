<?php

namespace App\Notifications;

use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanDisetujuiNotification extends Notification
{
    use Queueable;

    public function __construct(public PengajuanSurat $pengajuan)
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

        $pengajuan = $this->pengajuan->loadMissing(['jenisSurat', 'user.desa.kecamatan.kota.provinsi']);

        return (new MailMessage)
            ->subject('SADESA - Pengajuan Surat Anda Telah Disetujui')
            ->greeting('Halo, '.$notifiable->name)
            ->line('Pengajuan surat Anda telah disetujui oleh Admin Desa.')
            ->line('')
            ->line('Informasi:')
            ->line('Nama Desa: '.($desa?->nama ?? '-'))
            ->line('Kecamatan: '.($kecamatan?->nama ?? '-'))
            ->line('Kota/Kabupaten: '.($kota?->nama ?? '-'))
            ->line('Provinsi: '.($provinsi?->nama ?? '-'))
            ->line('Nomor Pengajuan: '.($pengajuan->nomor_pengajuan ?? '-'))
            ->line('Jenis Surat: '.($pengajuan->jenisSurat?->nama ?? '-'))
            ->line('Nomor Surat: '.($pengajuan->dokumen?->nomor_surat ?? '-'))
            ->line('Status: Disetujui')
            ->line('Tanggal: '.now()->translatedFormat('d F Y'))
            ->action('Lihat Pengajuan', route('masyarakat.pengajuan.show', $pengajuan, true))
            ->salutation('SADESA\nSistem Administrasi Desa');
    }
}
