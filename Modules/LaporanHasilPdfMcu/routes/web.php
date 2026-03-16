<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanHasilPdfMcu\Http\Controllers\LaporanHasilPdfMcuController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\Rdmp\LaporanPdfMcuRdmpController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\Ruv\LaporanPdfMcuRuvController;
use Modules\LaporanHasilPdfMcu\Http\Controllers\Umum\LaporanPdfMcuUmumController;

Route::get('/laporan-pdf-mcu', [LaporanHasilPdfMcuController::class, 'index'])->middleware('auth');
Route::get('/detail-laporan-pdf-mcu/umum/{no_rawat}', [LaporanPdfMcuUmumController::class, 'index'])->middleware('auth');
Route::get('/detail-laporan-pdf-mcu/RDMP/{no_rawat}', [LaporanPdfMcuRdmpController::class, 'index'])->middleware('auth');
Route::get('/detail-laporan-pdf-mcu/RU-V/{no_rawat}', [LaporanPdfMcuRuvController::class, 'index'])->middleware('auth');

Route::get('/detail-laporan-pdf-pasien-mcu/umum/{no_rawat}', [LaporanPdfMcuUmumController::class, 'index'])->middleware('auth:pasien');
Route::get('/detail-laporan-pdf-pasien-mcu/RDMP/{no_rawat}', [LaporanPdfMcuRdmpController::class, 'index'])->middleware('auth:pasien');
Route::get('/detail-laporan-pdf-pasien-mcu/RU-V/{no_rawat}', [LaporanPdfMcuRuvController::class, 'index'])->middleware('auth:pasien');

Route::post('/laporan-pdf-mcu', [LaporanHasilPdfMcuController::class, 'show'])->middleware('auth');

Route::get('/qrcode/dokter-penanggungjawab/{no_rawat}', [LaporanHasilPdfMcuController::class, 'p_jawab'])->middleware('auth');
Route::get('/qrcode/dokter-pemeriksa/{kode}/{no_rawat}', [LaporanHasilPdfMcuController::class, 'dr_periksa'])->middleware('auth');