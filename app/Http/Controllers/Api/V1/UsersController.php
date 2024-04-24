<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\UserCaptured;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UsersController
{
    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        event(new UserCaptured(
            $user->created_at->toImmutable(),
            $user->id,
        ));

        return new JsonResponse([
            'id' => $user->id,
            'email' => $user->email,
        ], Response::HTTP_CREATED);
    }

    public function delete(User $user): JsonResponse
    {
        $user->delete();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
