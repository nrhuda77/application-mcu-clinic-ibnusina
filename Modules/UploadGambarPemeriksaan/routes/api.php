<?php

use Illuminate\Support\Facades\Route;
use Modules\UploadGambarPemeriksaan\Http\Controllers\UploadGambarPemeriksaanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('uploadgambarpemeriksaans', UploadGambarPemeriksaanController::class)->names('uploadgambarpemeriksaan');
});
