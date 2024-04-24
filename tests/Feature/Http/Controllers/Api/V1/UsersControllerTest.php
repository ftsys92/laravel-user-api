<?php

namespace Tests\Feature;

use App\Jobs\ProcessUserCapture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_user(): void
    {
        Queue::fake();

        $email = 'acme@qwerty.xyz';
        $password = 'secret12345678';

        $response = $this->post('/api/users', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(200);

        Queue::assertPushed(ProcessUserCapture::class, 1);
        $jobs = collect(Queue::pushedJobs());
        $jobs->flatten()->first()->handle();

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
    }
}
