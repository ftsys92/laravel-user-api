<?php

namespace App\Providers;

use App\Events\UserCapture;
use App\Listeners\UserCaptureListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCapture::class => [
            UserCaptureListener::class,
        ]
    ];
}
