<?php

namespace App\Notifications;

use App\Models\TransparansiAnggaran;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransparansiAnggaranBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public TransparansiAnggaran $transparansi)
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

        return (new MailMessage)
            ->subject('SADESA - Informasi Transparansi Anggaran Terbaru')
            ->greeting('Halo, '.$notifiable->name)
            ->line('Informasi Transparansi Anggaran terbaru telah dipublikasikan.')
            ->line('Nama Desa: '.($desa?->nama ?? '-'))
            ->line('Kecamatan: '.($kecamatan?->nama ?? '-'))
            ->line('Kota/Kabupaten: '.($kota?->nama ?? '-'))
            ->line('Provinsi: '.($provinsi?->nama ?? '-'))
            ->line('Judul: '.($this->transparansi->judul ?? '-'))
            ->line('Periode: '.($this->transparansi->periode ?? '-'))
            ->line('Deskripsi: '.($this->transparansi->deskripsi ?? '-'))
            ->action('Lihat Transparansi Anggaran', route('masyarakat.transparansi.show', $this->transparansi, true))
            ->salutation('SADESA\nSistem Administrasi Desa');
    }
}
