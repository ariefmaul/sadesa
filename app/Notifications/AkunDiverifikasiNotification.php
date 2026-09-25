<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AkunDiverifikasiNotification extends Notification
{
    use Queueable;

    public function __construct(public User $user, public string $status) {}

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

        $message = $this->status === 'disetujui'
            ? 'Akun Anda telah disetujui untuk masuk dan menjadi warga di desa ini.'
            : 'Akun Anda ditolak untuk masuk ke desa ini. Silakan hubungi admin desa untuk informasi lebih lanjut.';

        $subject = $this->status === 'disetujui'
            ? 'SADESA - Akun Anda Telah Disetujui'
            : 'SADESA - Status Verifikasi Akun Anda';

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Halo, '.$notifiable->name)
            ->line($message)
            ->line('Nama Desa: '.($desa?->nama ?? '-'))
            ->line('Kecamatan: '.($kecamatan?->nama ?? '-'))
            ->line('Kota/Kabupaten: '.($kota?->nama ?? '-'))
            ->line('Provinsi: '.($provinsi?->nama ?? '-'))
            ->line('Status Verifikasi: '.($this->status === 'disetujui' ? 'Disetujui' : 'Ditolak'))
            ->action('Masuk ke Dashboard', route('dashboard', [], true))
            ->salutation('SADESA\nSistem Administrasi Desa');
    }
}
