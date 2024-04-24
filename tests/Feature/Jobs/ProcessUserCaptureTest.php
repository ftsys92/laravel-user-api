<?php

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessUserCapture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProcessUserCaptureTest extends TestCase
{
    use RefreshDatabase;

    public function test_creates_user(): void
    {
        $email = 'acme@qwerty.xyz';
        $passwordHash = Hash::make('secret12345678');

        (new ProcessUserCapture($email, $passwordHash))->handle();

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'password' => $passwordHash,
        ]);
    }
}
