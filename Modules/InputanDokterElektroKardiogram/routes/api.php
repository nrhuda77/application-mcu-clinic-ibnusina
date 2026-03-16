<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterElektroKardiogram\Http\Controllers\InputanDokterElektroKardiogramController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inputandokterelektrokardiograms', InputanDokterElektroKardiogramController::class)->names('inputandokterelektrokardiogram');
});
