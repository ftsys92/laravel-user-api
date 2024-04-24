<?php

use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
Route::delete('/users/{user}', [UsersController::class, 'delete']);
