<?php

namespace App\Events;

use DateTimeImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCaptured
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public DateTimeImmutable $at, public string $userId)
    {
    }
}
