<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingRegistrasi\Http\Controllers\BookingRegistrasiController;

Route::get('/booking-registrasi', [BookingRegistrasiController::class, 'index'])->middleware('auth');
Route::post('/booking-registrasi', [BookingRegistrasiController::class, 'show'])->middleware('auth');
Route::get('/ajax-select-booking-registrasi', [BookingRegistrasiController::class, 'ajax_select'])->middleware('auth');
Route::get('/get-booking-registrasi/{no_rkm_medis}', [BookingRegistrasiController::class, 'get_select'])->middleware('auth');
Route::post('/insert-booking-registrasi', [BookingRegistrasiController::class, 'store'])->middleware('auth');
Route::get('/booking-registrasi/get-noreg/{kd_dokter}', [BookingRegistrasiController::class, 'ajax_noreg'])->middleware('auth');
Route::get('/ajax-data-booking-registrasi/{no_rkm_medis}/{tgl_periksa}', [BookingRegistrasiController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-booking-registrasi', [BookingRegistrasiController::class, 'update'])->middleware('auth');
Route::get('/hapus-booking-registrasi/{no_rkm_medis}/{tgl_periksa}', [BookingRegistrasiController::class, 'destroy'])->middleware('auth');