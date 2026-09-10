<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MasyarakatBaruNotification extends Notification
{
    use Queueable;

    public function __construct(public User $user)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $this->user->loadMissing(['desa']);

        return [
            'type' => 'masyarakat_baru',
            'title' => 'Permintaan Verifikasi Masyarakat',
            'message' => 'Akun '.($this->user->name ?? 'pengguna').' meminta verifikasi untuk masuk ke desa.',
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'desa_id' => $this->user->desa_id,
            'created_at' => now()->toDateTimeString(),
            'route' => route('admin.masyarakat.show', $this->user, true),
        ];
    }
}
