<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterAudiogram\Http\Controllers\Audiogram\InputanDokterAudiogramController as AudiogramInputanDokterAudiogramController;
use Modules\InputanDokterAudiogram\Http\Controllers\InputanDokterAudiogramController;

Route::get('/hasil-inputan-dokter-audiogram', [InputanDokterAudiogramController::class, 'index'])->middleware('auth');
Route::post('/hasil-inputan-dokter-audiogram', [InputanDokterAudiogramController::class, 'show'])->middleware('auth');
Route::get('/detail-hasil-inputan-dokter-audiogram/{no_rawat}', [AudiogramInputanDokterAudiogramController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-audiogram/{no_rawat}', [AudiogramInputanDokterAudiogramController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-audiogram/{no_rawat}', [AudiogramInputanDokterAudiogramController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-audiogram', [AudiogramInputanDokterAudiogramController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-audiogram', [AudiogramInputanDokterAudiogramController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-audiogram/{no_rawat}', [AudiogramInputanDokterAudiogramController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-audiogram', [AudiogramInputanDokterAudiogramController::class, 'auto_save_audiogram'])->middleware('auth');
Route::get('/pdf-preview-temuan-audiogram/{no_rawat}', [AudiogramInputanDokterAudiogramController::class, 'pdf_preview_audiogram'])->middleware('auth');