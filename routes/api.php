<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [UserController::class, 'me'])->name('me');

    Route::apiResource('animal', AnimalController::class);

    Route::apiResource('shelter', ShelterController::class);

    Route::apiResource('species', SpeciesController::class);
});
