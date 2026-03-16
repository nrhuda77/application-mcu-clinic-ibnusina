<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterAudiogram\Http\Controllers\InputanDokterAudiogramController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inputandokteraudiograms', InputanDokterAudiogramController::class)->names('inputandokteraudiogram');
});
