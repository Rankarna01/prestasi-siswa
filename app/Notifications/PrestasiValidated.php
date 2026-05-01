<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PrestasiValidated extends Notification
{
    use Queueable;
    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database']; // Simpan ke database sesuai sistem kita
    }

    public function toArray($notifiable)
    {
        return [
            'judul' => $this->details['judul'],
            'pesan' => $this->details['pesan'],
            'url'   => $this->details['url'],
            'warna' => $this->details['warna'],
            'icon'  => $this->details['icon'],
        ];
    }
}