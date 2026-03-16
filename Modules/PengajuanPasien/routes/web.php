<?php

use Illuminate\Support\Facades\Route;
use Modules\PengajuanPasien\Http\Controllers\PengajuanPasienController;

Route::get('/pengajuan-pasien',[PengajuanPasienController::class, 'index'])->middleware('auth');
Route::post('/pengajuan-pasien',[PengajuanPasienController::class, 'show'])->middleware('auth');
Route::post('/insert-pengajuan-pasien', [PengajuanPasienController::class, 'store'])->middleware('auth');
Route::post('/edit-pengajuan-pasien',[PengajuanPasienController::class, 'update'])->middleware('auth');
Route::get('/ajax-detail-pengajuan-pasien/{id}',[PengajuanPasienController::class, 'ajax_detail'])->middleware('auth');