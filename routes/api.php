<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/me', [UserController::class, 'me'])
    ->middleware('auth:api')
    ->name('me');

Route::apiResource('animal', AnimalController::class)
    ->middleware('auth:api');

Route::apiResource('shelter', ShelterController::class)
    ->middleware('auth:api');
