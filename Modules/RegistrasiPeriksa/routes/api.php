<?php

use Illuminate\Support\Facades\Route;
use Modules\RegistrasiPeriksa\Http\Controllers\RegistrasiPeriksaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('registrasiperiksas', RegistrasiPeriksaController::class)->names('registrasiperiksa');
});
