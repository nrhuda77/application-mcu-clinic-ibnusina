<?php

use Illuminate\Support\Facades\Route;
use Modules\ScorePemeriksaan\Http\Controllers\ScorePemeriksaanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('scorepemeriksaans', ScorePemeriksaanController::class)->names('scorepemeriksaan');
});
