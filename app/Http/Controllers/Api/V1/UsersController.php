<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\UserCapture;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email:rfc'],
        ]);

        $email = $request->input('email');

        event(new UserCapture(
            $email
        ));

        return new JsonResponse([
            'message' => 'Ok',
        ]);
    }

    public function delete(User $user): JsonResponse
    {
       $user->delete();

        return new JsonResponse([
            'message' => 'Ok',
        ]);
    }
}
