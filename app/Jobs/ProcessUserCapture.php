<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessUserCapture implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $email)
    {
    }

    public function handle(): void
    {
        $password = Hash::make(Str::password(16));
        $user = User::create([
            'email' => $this->email,
            'password' => $password,
        ]);

        Log::info([
            'message' => sprintf('"%s" job has been handled', self::class),
            'queue' => $this->queue,
            'user_id' => $user->id,
        ]);
    }
}
