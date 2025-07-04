<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;

class SendLoginNotification
{
    public function handle(Login $event)
    {
        session()->flash('success', 'Berhasil Login dan Masuk ke Aplikasi');
    }
}
