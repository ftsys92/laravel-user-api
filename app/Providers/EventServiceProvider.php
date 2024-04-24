<?php

namespace App\Providers;

use App\Events\UserCaptured;
use App\Listeners\UserCapturedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCaptured::class => [
            UserCapturedListener::class,
        ]
    ];
}
