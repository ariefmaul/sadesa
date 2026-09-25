<?php

namespace App\Notifications;

use App\Models\PengumumanDesa;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengumumanDesaBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public PengumumanDesa $pengumuman) {}

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

        return (new MailMessage)
            ->subject('SADESA - Pengumuman Desa Baru')
            ->greeting('Halo, '.$notifiable->name)
            ->line('Pengumuman baru telah dipublikasikan di desa Anda.')
            ->line('Nama Desa: '.($desa?->nama ?? '-'))
            ->line('Kecamatan: '.($kecamatan?->nama ?? '-'))
            ->line('Kota/Kabupaten: '.($kota?->nama ?? '-'))
            ->line('Provinsi: '.($provinsi?->nama ?? '-'))
            ->line('Judul: '.($this->pengumuman->judul ?? '-'))
            ->line('Tanggal Publikasi: '.($this->pengumuman->published_at?->translatedFormat('d F Y') ?? '-'))
            ->line('Isi: '.strip_tags($this->pengumuman->isi ?? '-'))
            ->action('Lihat Pengumuman', route('masyarakat.pengumuman.show', $this->pengumuman, true))
            ->salutation('SADESA\nSistem Administrasi Desa');
    }
}
