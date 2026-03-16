<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanNonLab\Http\Controllers\PemeriksaanNonLabController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pemeriksaannonlabs', PemeriksaanNonLabController::class)->names('pemeriksaannonlab');
});
