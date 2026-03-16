<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingRegistrasi\Http\Controllers\BookingRegistrasiController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bookingregistrasis', BookingRegistrasiController::class)->names('bookingregistrasi');
});
