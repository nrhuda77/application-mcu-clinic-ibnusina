<?php

use Illuminate\Support\Facades\Route;
use Modules\Pasien\Http\Controllers\PasienController;

Route::get('/pasien',[PasienController::class, 'index'])->middleware('auth');
Route::post('/pasien',[PasienController::class, 'show'])->middleware('auth');
Route::get('/ajax-norkm',[PasienController::class, 'ajax_norkm'])->middleware('auth');
Route::post('/insert-pasien', [PasienController::class, 'store'])->middleware('auth');
Route::post('/edit-pasien',[PasienController::class, 'update'])->middleware('auth');
Route::get('/ajax-detail-pasien/{no_rkm_medis}',[PasienController::class, 'ajax_detail'])->middleware('auth');