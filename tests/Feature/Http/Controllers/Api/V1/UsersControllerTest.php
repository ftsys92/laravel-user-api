<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Events\UserCapture;
use App\Jobs\ProcessUserCapture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
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

        $response->assertStatus(200);

        Event::assertDispatched(UserCapture::class, 1);
    }
}
