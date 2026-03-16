<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterRongentDada\Http\Controllers\InputanDokterRongentDadaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inputandokterrongentdadas', InputanDokterRongentDadaController::class)->names('inputandokterrongentdada');
});
