<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterSpirometri\Http\Controllers\InputanDokterSpirometriController;
use Modules\InputanDokterSpirometri\Http\Controllers\Spirometri\InputanDokterSpirometriController as SpirometriInputanDokterSpirometriController;

Route::get('/hasil-inputan-dokter-spirometri', [InputanDokterSpirometriController::class, 'index'])->middleware('auth');
Route::post('/hasil-inputan-dokter-spirometri', [InputanDokterSpirometriController::class, 'show'])->middleware('auth');
Route::get('/detail-hasil-inputan-dokter-spirometri/{no_rawat}', [SpirometriInputanDokterSpirometriController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-spirometri/{no_rawat}', [SpirometriInputanDokterSpirometriController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-spirometri/{no_rawat}', [SpirometriInputanDokterSpirometriController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-spirometri', [SpirometriInputanDokterSpirometriController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-spirometri', [SpirometriInputanDokterSpirometriController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-spirometri/{no_rawat}', [SpirometriInputanDokterSpirometriController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-spirometri', [SpirometriInputanDokterSpirometriController::class, 'auto_save_spirometri'])->middleware('auth');
Route::get('/pdf-preview-temuan-spirometri/{no_rawat}', [SpirometriInputanDokterSpirometriController::class, 'pdf_preview_spirometri'])->middleware('auth');