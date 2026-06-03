<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusPengajuanNotification extends Notification
{
    use Queueable;

    public $status;
    public $pesan;
    public $jenis;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $pesan, $jenis = 'info')
    {
        $this->status = $status;
        $this->pesan = $pesan;
        $this->jenis = $jenis; // 'success', 'danger', 'info', 'warning'
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'status' => $this->status,
            'pesan' => $this->pesan,
            'jenis' => $this->jenis,
        ];
    }
}
