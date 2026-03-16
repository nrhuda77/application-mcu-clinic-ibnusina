<?php

use Illuminate\Support\Facades\Route;
use Modules\RegistrasiPeriksa\Http\Controllers\RegistrasiPeriksaController;

Route::get('/registrasi-periksa', [RegistrasiPeriksaController::class, 'index'])->middleware('auth');
Route::post('/registrasi-periksa', [RegistrasiPeriksaController::class, 'show'])->middleware('auth');
Route::get('/ajax-select-registrasi-periksa', [RegistrasiPeriksaController::class, 'ajax_select'])->middleware('auth');
Route::get('/get-registrasi-periksa/{no_rkm_medis}', [RegistrasiPeriksaController::class, 'get_select'])->middleware('auth');
Route::post('/insert-registrasi-periksa', [RegistrasiPeriksaController::class, 'store'])->middleware('auth');
Route::get('/registrasi-periksa/get-noreg/{kd_dokter}', [RegistrasiPeriksaController::class, 'ajax_noreg'])->middleware('auth');
Route::get('/registrasi-periksa/get-no-rawat', [RegistrasiPeriksaController::class, 'ajax_norawat'])->middleware('auth');
Route::get('/ajax-data-registrasi-periksa/{no_rawat}', [RegistrasiPeriksaController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-registrasi-periksa', [RegistrasiPeriksaController::class, 'update'])->middleware('auth');
Route::get('/hapus-registrasi-periksa/{no_rawat}', [RegistrasiPeriksaController::class, 'destroy'])->middleware('auth');

Route::get('/ajax-data-registrasi-kuisoner/{no_rawat}', [RegistrasiPeriksaController::class, 'ajax_data_kuisoner'])->middleware('auth');
Route::post('/insert-registrasi-kuisoner', [RegistrasiPeriksaController::class, 'kuisoner_store'])->middleware('auth');

Route::get('/ajax-data-Kategori/{no_rawat}', [RegistrasiPeriksaController::class, 'ajax_kategori'])->middleware('auth');
Route::post('/insert-registrasi-kategori', [RegistrasiPeriksaController::class, 'kategori_store'])->middleware('auth');
Route::post('/update-registrasi-kategori', [RegistrasiPeriksaController::class, 'kategori_update'])->middleware('auth');