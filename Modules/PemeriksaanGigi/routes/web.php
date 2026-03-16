<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanGigi\Http\Controllers\PemeriksaanGigiController;

Route::get('/pemeriksaan-gigi', [PemeriksaanGigiController::class, 'index'])->middleware('auth');
Route::post('/pemeriksaan-gigi', [PemeriksaanGigiController::class, 'show'])->middleware('auth');
Route::get('/detail-pemeriksaan-gigi/{id}', [PemeriksaanGigiController::class, 'detail'])->middleware('auth');
Route::post('/insert-pemeriksaan-gigi', [PemeriksaanGigiController::class, 'store'])->middleware('auth');
Route::post('/update-pemeriksaan-gigi', [PemeriksaanGigiController::class, 'update'])->middleware('auth');
Route::get('/get-pemeriksaan-gigi/{id}', [PemeriksaanGigiController::class, 'ajax_data'])->middleware('auth');
Route::get('/delete-pemeriksaan-gigi/{id}', [PemeriksaanGigiController::class, 'destroy'])->middleware('auth');
Route::get('/delete-pemeriksaan-gigi-all/{no_rawat}', [PemeriksaanGigiController::class, 'destroy_all'])->middleware('auth');