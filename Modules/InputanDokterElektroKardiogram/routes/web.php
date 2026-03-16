<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterElektroKardiogram\Http\Controllers\ElektroKardiogram\InputanDokterElektroKardiogramController as ElektroKardiogramInputanDokterElektroKardiogramController;
use Modules\InputanDokterElektroKardiogram\Http\Controllers\InputanDokterElektroKardiogramController;

Route::get('/hasil-inputan-dokter-elektrokardiogram', [InputanDokterElektroKardiogramController::class, 'index'])->middleware('auth');
Route::post('/hasil-inputan-dokter-elektrokardiogram', [InputanDokterElektroKardiogramController::class, 'show'])->middleware('auth');
Route::get('/detail-hasil-inputan-dokter-elektrokardiogram/{no_rawat}', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-elektrokardiogram/{no_rawat}', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-elektrokardiogram/{no_rawat}', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-elektrokardiogram', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-elektrokardiogram', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-elektrokardiogram/{no_rawat}', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-elektrokardiogram', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'auto_save_elektrokardiogram'])->middleware('auth');
Route::get('/pdf-preview-temuan-elektrokardiogram/{no_rawat}', [ElektroKardiogramInputanDokterElektroKardiogramController::class, 'pdf_preview_elektrokardiogram'])->middleware('auth');