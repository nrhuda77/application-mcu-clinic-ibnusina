<?php

use Illuminate\Support\Facades\Route;
use Modules\Pengguna\Http\Controllers\PenggunaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('penggunas', PenggunaController::class)->names('pengguna');
});
