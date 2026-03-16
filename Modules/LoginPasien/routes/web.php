<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginPasien\Http\Controllers\LoginPasienController;

Route::get('/', [LoginPasienController::class, 'index'])->name('login');
Route::post('/login-pasien', [LoginPasienController::class, 'login']);
Route::post('/logout-pasien', [LoginPasienController::class, 'logout']);