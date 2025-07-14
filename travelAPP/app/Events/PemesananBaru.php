<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PemesananBaru implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $nama;

    public function __construct($nama)
    {
        $this->nama = $nama;
    }

    public function broadcastOn()
    {
        return new Channel('pemesanan-channel');
    }

    public function broadcastAs()
    {
        return 'pemesanan-masuk';
    }
}

