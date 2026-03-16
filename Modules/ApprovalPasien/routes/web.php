<?php

use Illuminate\Support\Facades\Route;
use Modules\ApprovalPasien\Http\Controllers\ApprovalPasienController;
Route::get('/approval-pasien', [ApprovalPasienController::class,'index'])->middleware('auth');
Route::post('/approval-pasien',[ApprovalPasienController::class, 'show'])->middleware('auth');
Route::post('/insert-approval-pasien', [ApprovalPasienController::class, 'approval'])->middleware('auth');
Route::post('/edit-approval-pasien',[ApprovalPasienController::class, 'update_approval'])->middleware('auth');
Route::get('/ajax-detail-approval-pasien/{id}',[ApprovalPasienController::class, 'ajax_detail'])->middleware('auth');
Route::post('/approve', [ApprovalPasienController::class, 'approve'])->middleware('auth');
Route::get('/ajax_number', [ApprovalPasienController::class, 'ajax_number'])->middleware('auth');
Route::get('/delete-riwayat-approval-pasien/{id}',[ApprovalPasienController::class, 'destroy'])->middleware('auth');
Route::get('/tolak-approval-pasien/{id}',[ApprovalPasienController::class, 'tolak'])->middleware('auth');

Route::get('/ajax-kelurahan',[ApprovalPasienController::class, 'kelurahan'])->name('ajax.kelurahan')->middleware('auth');
Route::get('/ajax-kabupaten',[ApprovalPasienController::class, 'kabupaten'])->name('ajax.kabupaten')->middleware('auth');
Route::get('/ajax-kecamatan',[ApprovalPasienController::class, 'kecamatan'])->name('ajax.kecamatan')->middleware('auth');