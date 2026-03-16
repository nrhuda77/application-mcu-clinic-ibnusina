<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterSpirometri\Http\Controllers\InputanDokterSpirometriController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inputandokterspirometris', InputanDokterSpirometriController::class)->names('inputandokterspirometri');
});
