<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\UserCapture;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
            'password' => ['required', Password::min(8)],
        ]);

        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        event(new UserCapture(
            $email,
            $password,
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
