<?php

namespace App\Jobs;

use App\Models\User;
use Faker\Generator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessUserCaptured implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $userId)
    {
    }

    public function handle(Generator $faker): void
    {
        $user = User::findOrFail($this->userId);
        $user->name = $faker->name();
        $user->save();

        Log::info([
            'message' => sprintf('"%s" job has been handled', self::class),
            'queue' => $this->queue,
            'user_id' => $this->userId,
        ]);
    }
}
