<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginAdmin\Http\Controllers\LoginAdminController;

Route::get('/login-admin', [LoginAdminController::class, 'index']);
Route::post('/login-admin', [LoginAdminController::class, 'login']);
Route::post('/logout-admin', [LoginAdminController::class, 'logout']);