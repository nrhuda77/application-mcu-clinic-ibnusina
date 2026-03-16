<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanHasilDokter\Http\Controllers\InputanHasilDokterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inputanhasildokters', InputanHasilDokterController::class)->names('inputanhasildokter');
});
