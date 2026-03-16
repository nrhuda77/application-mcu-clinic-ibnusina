<?php

use Illuminate\Support\Facades\Route;
use Modules\BookingPeriksa\Http\Controllers\BookingPeriksaController;

Route::get('/booking-periksa', [BookingPeriksaController::class, 'index'])->middleware('auth');
Route::post('/booking-periksa', [BookingPeriksaController::class, 'show'])->middleware('auth');