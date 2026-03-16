<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanLanjut\Http\Controllers\PemeriksaanLanjutController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pemeriksaanlanjuts', PemeriksaanLanjutController::class)->names('pemeriksaanlanjut');
});
