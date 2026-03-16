<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanHasilPdfMcu\Http\Controllers\LaporanHasilPdfMcuController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('laporanhasilpdfmcus', LaporanHasilPdfMcuController::class)->names('laporanhasilpdfmcu');
});
