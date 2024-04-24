<?php

namespace Tests\Feature\Listeners;

use App\Events\UserCapture;
use App\Jobs\ProcessUserCapture;
use App\Listeners\UserCaptureListener;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class UserCaptureListenerTest extends TestCase
{
    public function test_dispatches_pricess_user_capture_job(): void
    {
        Queue::fake();

        $email = 'acme@qwerty.xyz';
        $passwordHash = 'secret12345678';

        (new UserCaptureListener())->handle(
            new UserCapture($email, $passwordHash)
        );

        Queue::assertPushed(ProcessUserCapture::class, 1);

        $jobs = collect(Queue::pushedJobs());
        $job = $jobs->flatten()->first();

        self::assertEquals($email, $job->email);
        self::assertEquals($passwordHash, $job->passwordHash);
    }
}