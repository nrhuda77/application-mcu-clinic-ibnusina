<?php

use Illuminate\Support\Facades\Route;
use Modules\Kuisoner\Http\Controllers\KuisonerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('kuisoners', KuisonerController::class)->names('kuisoner');
});
