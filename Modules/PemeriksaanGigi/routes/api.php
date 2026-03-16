<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanGigi\Http\Controllers\PemeriksaanGigiController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pemeriksaangigis', PemeriksaanGigiController::class)->names('pemeriksaangigi');
});
