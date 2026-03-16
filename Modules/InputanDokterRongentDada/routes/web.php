<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanDokterRongentDada\Http\Controllers\InputanDokterRongentDadaController;
use Modules\InputanDokterRongentDada\Http\Controllers\RongentDada\InputanDokterRongentDadaController as RongentDadaInputanDokterRongentDadaController;

Route::get('/hasil-inputan-dokter-rongentdada', [InputanDokterRongentDadaController::class, 'index'])->middleware('auth');
Route::post('/hasil-inputan-dokter-rongentdada', [InputanDokterRongentDadaController::class, 'show'])->middleware('auth');
Route::get('/detail-hasil-inputan-dokter-rongentdada/{no_rawat}', [RongentDadaInputanDokterRongentDadaController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-rongentdada/{no_rawat}', [RongentDadaInputanDokterRongentDadaController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-rongentdada/{no_rawat}', [RongentDadaInputanDokterRongentDadaController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-rongentdada', [RongentDadaInputanDokterRongentDadaController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-rongentdada', [RongentDadaInputanDokterRongentDadaController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-rongentdada/{no_rawat}', [RongentDadaInputanDokterRongentDadaController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-rongentdada', [RongentDadaInputanDokterRongentDadaController::class, 'auto_save_rongentdada'])->middleware('auth');
Route::get('/pdf-preview-temuan-rongentdada/{no_rawat}', [RongentDadaInputanDokterRongentDadaController::class, 'pdf_preview_rongentdada'])->middleware('auth');