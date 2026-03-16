<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanMcu\Http\Controllers\LaporanMcuController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('laporanmcus', LaporanMcuController::class)->names('laporanmcu');
});
