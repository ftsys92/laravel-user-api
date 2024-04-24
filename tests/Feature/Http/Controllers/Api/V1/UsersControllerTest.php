<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Events\UserCaptured;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_user(): void
    {
        Event::fake();

        $email = 'acme@qwerty.xyz';
        $password = 'secret12345678';

        $response = $this->post('/api/users', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(201);

        Event::assertDispatched(UserCaptured::class, 1);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name' => null,
        ]);
    }
}
