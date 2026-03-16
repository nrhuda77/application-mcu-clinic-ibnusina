<?php

use Illuminate\Support\Facades\Route;
use Modules\ApprovalPasien\Http\Controllers\ApprovalPasienController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('approvalpasiens', ApprovalPasienController::class)->names('approvalpasien');
});
