<?php

use Illuminate\Support\Facades\Route;
use Modules\Pasien\Http\Controllers\PasienController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pasiens', PasienController::class)->names('pasien');
});
