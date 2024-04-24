<?php

namespace App\Listeners;

use App\Events\UserCaptured;
use App\Jobs\ProcessUserCaptured;

class UserCapturedListener
{
    public function __construct()
    {
    }

    public function handle(UserCaptured $event): void
    {
        ProcessUserCaptured::dispatch(
            $event->userId,
        );
    }
}
