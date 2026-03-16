<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingPeriksa\Http\Controllers\BookingPeriksaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bookingperiksas', BookingPeriksaController::class)->names('bookingperiksa');
});
