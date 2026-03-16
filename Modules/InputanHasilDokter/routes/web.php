<?php

use Illuminate\Support\Facades\Route;
use Modules\InputanHasilDokter\Http\Controllers\InputanHasilDokterController;
use Modules\InputanHasilDokter\Http\Controllers\Umum\InputanDokterController;
use Modules\InputanHasilDokter\Http\Controllers\Rdmp\InputanDokterController as RdmpInputanDokterController;
use Modules\InputanHasilDokter\Http\Controllers\Ruv\InputanDokterController as RuvInputanDokterController;

Route::get('/hasil-inputan-dokter', [InputanHasilDokterController::class, 'index'])->middleware('auth');
Route::post('/hasil-inputan-dokter', [InputanHasilDokterController::class, 'show'])->middleware('auth');
Route::get('/detail-hasil-inputan-dokter-umum/{no_rawat}', [InputanDokterController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-umum/{no_rawat}', [InputanDokterController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-umum/{no_rawat}', [InputanDokterController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-umum', [InputanDokterController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-umum', [InputanDokterController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-umum/{no_rawat}', [InputanDokterController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-umum', [InputanDokterController::class, 'auto_save_temuan'])->middleware('auth');
Route::get('/pdf-preview-temuan-umum/{no_rawat}', [InputanDokterController::class, 'pdf_preview_temuan'])->middleware('auth');
Route::post('/auto-save-saran-umum', [InputanDokterController::class, 'auto_save_saran'])->middleware('auth');
Route::get('/pdf-preview-saran-umum/{no_rawat}', [InputanDokterController::class, 'pdf_preview_saran'])->middleware('auth');
Route::post('/auto-save-select-umum', [InputanDokterController::class, 'auto_save_select'])->middleware('auth');

Route::get('/detail-hasil-inputan-dokter-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-rdmp', [RdmpInputanDokterController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-rdmp', [RdmpInputanDokterController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-rdmp', [RdmpInputanDokterController::class, 'auto_save_temuan'])->middleware('auth');
Route::get('/pdf-preview-temuan-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'pdf_preview_temuan'])->middleware('auth');
Route::post('/auto-save-saran-rdmp', [RdmpInputanDokterController::class, 'auto_save_saran'])->middleware('auth');
Route::get('/pdf-preview-saran-rdmp/{no_rawat}', [RdmpInputanDokterController::class, 'pdf_preview_saran'])->middleware('auth');
Route::post('/auto-save-select-rdmp', [RdmpInputanDokterController::class, 'auto_save_select'])->middleware('auth');

Route::get('/detail-hasil-inputan-dokter-ruv/{no_rawat}', [RuvInputanDokterController::class, 'index'])->middleware('auth');
Route::get('/get-hasil-inputan-dokter-ruv/{no_rawat}', [RuvInputanDokterController::class, 'ajax_data'])->middleware('auth');
Route::get('/edit-hasil-inputan-dokter-ruv/{no_rawat}', [RuvInputanDokterController::class, 'edit'])->middleware('auth');
Route::post('/insert-hasil-inputan-dokter-ruv', [RuvInputanDokterController::class, 'store'])->middleware('auth');
Route::post('/update-hasil-inputan-dokter-ruv', [RuvInputanDokterController::class, 'update'])->middleware('auth');
Route::get('/delete-hasil-inputan-dokter-ruv/{no_rawat}', [RuvInputanDokterController::class, 'destroy'])->middleware('auth');
Route::post('/auto-save-temuan-ruv', [RuvInputanDokterController::class, 'auto_save_temuan'])->middleware('auth');
Route::get('/pdf-preview-temuan-ruv/{no_rawat}', [RuvInputanDokterController::class, 'pdf_preview_temuan'])->middleware('auth');
Route::post('/auto-save-saran-ruv', [RuvInputanDokterController::class, 'auto_save_saran'])->middleware('auth');
Route::get('/pdf-preview-saran-ruv/{no_rawat}', [RuvInputanDokterController::class, 'pdf_preview_saran'])->middleware('auth');
Route::post('/auto-save-select-ruv', [RuvInputanDokterController::class, 'auto_save_select'])->middleware('auth');