<?php

use Illuminate\Support\Facades\Route;
use Modules\PengajuanPasien\Http\Controllers\PengajuanPasienController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pengajuanpasiens', PengajuanPasienController::class)->names('pengajuanpasien');
});
