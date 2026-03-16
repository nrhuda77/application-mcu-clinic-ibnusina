<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginAdmin\Http\Controllers\LoginAdminController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('loginadmins', LoginAdminController::class)->names('loginadmin');
});
