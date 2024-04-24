<?php

namespace App\Listeners;

use App\Events\UserCapture;
use App\Jobs\ProcessUserCapture;

class UserCaptureListener
{
    public function __construct()
    {
    }

    public function handle(UserCapture $event): void
    {
        ProcessUserCapture::dispatch(
            $event->email,
            $event->passwordHash,
        );
    }
}
