<?php

namespace App\Notifications;

use App\Models\PengajuanSurat;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengajuanBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public PengajuanSurat $pengajuan)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $this->pengajuan->loadMissing(['user.desa', 'jenisSurat']);

        return [
            'type' => 'pengajuan_baru',
            'title' => 'Pengajuan surat baru',
            'message' => 'Pengajuan '.($this->pengajuan->jenisSurat?->nama ?? 'surat').' dari '.$this->pengajuan->user?->name,
            'pengajuan_id' => $this->pengajuan->id,
            'nomor_pengajuan' => $this->pengajuan->nomor_pengajuan,
            'jenis_surat' => $this->pengajuan->jenisSurat?->nama,
            'user_name' => $this->pengajuan->user?->name,
            'desa_id' => $this->pengajuan->user?->desa_id,
            'created_at' => now()->toDateTimeString(),
            'route' => route('admin.pengajuan.show', $this->pengajuan, true),
        ];
    }
}
