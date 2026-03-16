<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginPasien\Http\Controllers\LoginPasienController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('loginpasiens', LoginPasienController::class)->names('loginpasien');
});
