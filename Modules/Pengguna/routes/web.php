<?php

use Illuminate\Support\Facades\Route;
use Modules\Pengguna\Http\Controllers\PenggunaController;

Route::get('/pengguna', [PenggunaController::class, 'index'])->middleware('auth');
Route::post('/pengguna',[PenggunaController::class, 'show'])->middleware('auth');
Route::get('/ajax-detail-pengguna/{id}',[PenggunaController::class, 'ajax_detail'])->middleware('auth');
Route::post('/edit-pengguna',[PenggunaController::class, 'update'])->middleware('auth');
Route::post('/insert-pengguna', [PenggunaController::class, 'store'])->middleware('auth');
Route::get('/delete-pengguna/{id}', [PenggunaController::class, 'destroy'])->middleware('auth');