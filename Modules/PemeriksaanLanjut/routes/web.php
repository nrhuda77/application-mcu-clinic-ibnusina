<?php

use Illuminate\Support\Facades\Route;
use Modules\PemeriksaanLanjut\Http\Controllers\FisikKulitMata\FisikKulitMataController;
use Modules\PemeriksaanLanjut\Http\Controllers\GenitalAnusVetebrata\GenitalAnusController;
use Modules\PemeriksaanLanjut\Http\Controllers\PemeriksaanLanjutController;
use Modules\PemeriksaanLanjut\Http\Controllers\ThorackAbdomen\ThorackAbdomenController;
use Modules\PemeriksaanLanjut\Http\Controllers\VitalKondisiUmum\VitalKondisiUmumController;

Route::get('/vital-kondisi-umum', [PemeriksaanLanjutController::class, 'index'])->middleware('auth');
Route::post('/vital-kondisi-umum', [PemeriksaanLanjutController::class, 'show'])->middleware('auth');
Route::get('/detail-vital-kondisi-umum/{no_rawat}', [VitalKondisiUmumController::class, 'index'])->middleware('auth');
Route::get('/get-vital-kondisi-umum/{no_rawat}', [VitalKondisiUmumController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-vital-kondisi-umum', [VitalKondisiUmumController::class, 'store'])->middleware('auth');
Route::post('/update-vital-kondisi-umum', [VitalKondisiUmumController::class, 'update'])->middleware('auth');
Route::get('/delete-vital-kondisi-umum/{no_rawat}', [VitalKondisiUmumController::class, 'destroy'])->middleware('auth');

Route::get('/fisik-kulit-mata', [PemeriksaanLanjutController::class, 'index'])->middleware('auth');
Route::post('/fisik-kulit-mata', [PemeriksaanLanjutController::class, 'show'])->middleware('auth');
Route::get('/detail-fisik-kulit-mata/{no_rawat}', [FisikKulitMataController::class, 'index'])->middleware('auth');
Route::get('/get-fisik-kulit-mata/{no_rawat}', [FisikKulitMataController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-fisik-kulit-mata', [FisikKulitMataController::class, 'store'])->middleware('auth');
Route::post('/update-fisik-kulit-mata', [FisikKulitMataController::class, 'update'])->middleware('auth');
Route::get('/delete-fisik-kulit-mata/{no_rawat}', [FisikKulitMataController::class, 'destroy'])->middleware('auth');

Route::get('/thoraks-abdomen', [PemeriksaanLanjutController::class, 'index'])->middleware('auth');
Route::post('/thoraks-abdomen', [PemeriksaanLanjutController::class, 'show'])->middleware('auth');
Route::get('/detail-thoraks-abdomen/{no_rawat}', [ThorackAbdomenController::class, 'index'])->middleware('auth');
Route::get('/get-thoraks-abdomen/{no_rawat}', [ThorackAbdomenController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-thoraks-abdomen', [ThorackAbdomenController::class, 'store'])->middleware('auth');
Route::post('/update-thoraks-abdomen', [ThorackAbdomenController::class, 'update'])->middleware('auth');
Route::get('/delete-thoraks-abdomen/{no_rawat}', [ThorackAbdomenController::class, 'destroy'])->middleware('auth');

Route::get('/genital-anus', [PemeriksaanLanjutController::class, 'index'])->middleware('auth');
Route::post('/genital-anus', [PemeriksaanLanjutController::class, 'show'])->middleware('auth');
Route::get('/detail-genital-anus/{no_rawat}', [GenitalAnusController::class, 'index'])->middleware('auth');
Route::get('/get-genital-anus/{no_rawat}', [GenitalAnusController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-genital-anus', [GenitalAnusController::class, 'store'])->middleware('auth');
Route::post('/update-genital-anus', [GenitalAnusController::class, 'update'])->middleware('auth');
Route::get('/delete-genital-anus/{no_rawat}', [GenitalAnusController::class, 'destroy'])->middleware('auth');