<?php

use Illuminate\Support\Facades\Route;
use Modules\UploadGambarPemeriksaan\Http\Controllers\UploadGambarPemeriksaanController;

Route::get('/upload-gambar-pemeriksaan', [UploadGambarPemeriksaanController::class, 'index'])->middleware('auth');
Route::post('/upload-gambar-pemeriksaan', [UploadGambarPemeriksaanController::class, 'show'])->middleware('auth');
Route::get('/detail-upload-gambar-pemeriksaan/{no_rawat}', [UploadGambarPemeriksaanController::class, 'detail'])->middleware('auth');
Route::get('/get-upload-gambar-pemeriksaan/{no_rawat}', [UploadGambarPemeriksaanController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-upload-gambar-pemeriksaan', [UploadGambarPemeriksaanController::class, 'store'])->middleware('auth');
Route::post('/update-upload-gambar-pemeriksaan', [UploadGambarPemeriksaanController::class, 'update'])->middleware('auth');
Route::get('/delete-upload-gambar-pemeriksaan/{no_rawat}', [UploadGambarPemeriksaanController::class, 'destroy'])->middleware('auth');
Route::get('/delete-upload-gambar-pemeriksaan-all/{no_rawat}', [UploadGambarPemeriksaanController::class, 'destroy_all'])->middleware('auth');
Route::get('/gambar-pemeriksaan/{filename}', [UploadGambarPemeriksaanController::class, 'show_gambar'])->middleware('auth');