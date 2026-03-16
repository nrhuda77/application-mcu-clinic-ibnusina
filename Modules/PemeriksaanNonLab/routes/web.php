<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanNonLab\Http\Controllers\PemeriksaanNonLabController;

Route::get('/pemeriksaan-nonlab', [PemeriksaanNonLabController::class, 'index'])->middleware('auth');
Route::post('/pemeriksaan-nonlab', [PemeriksaanNonLabController::class, 'show'])->middleware('auth');
Route::get('/detail-pemeriksaan-nonlab/{no_rawat}', [PemeriksaanNonLabController::class, 'detail'])->middleware('auth');
Route::get('/get-pemeriksaan-nonlab/{no_rawat}', [PemeriksaanNonLabController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-pemeriksaan-nonlab', [PemeriksaanNonLabController::class, 'store'])->middleware('auth');
Route::post('/update-pemeriksaan-nonlab', [PemeriksaanNonLabController::class, 'update'])->middleware('auth');
Route::get('/delete-pemeriksaan-nonlab/{no_rawat}', [PemeriksaanNonLabController::class, 'destroy'])->middleware('auth');