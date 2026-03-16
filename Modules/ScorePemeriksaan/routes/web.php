<?php

use Illuminate\Support\Facades\Route;
use Modules\ScorePemeriksaan\Http\Controllers\JakartaCardiovascular\JakartaCardiovascularController;
use Modules\ScorePemeriksaan\Http\Controllers\Napfa\NapfaController;
use Modules\ScorePemeriksaan\Http\Controllers\ScorePemeriksaanController;

Route::get('/score-jakarta-cardiovascular', [ScorePemeriksaanController::class, 'index'])->middleware('auth');
Route::post('/score-jakarta-cardiovascular', [ScorePemeriksaanController::class, 'show'])->middleware('auth');
Route::get('/detail-score-jakarta-cardiovascular/{no_rawat}', [JakartaCardiovascularController::class, 'index'])->middleware('auth');
Route::get('/get-score-jakarta-cardiovascular/{no_rawat}', [JakartaCardiovascularController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-score-jakarta-cardiovascular', [JakartaCardiovascularController::class, 'store'])->middleware('auth');
Route::post('/update-score-jakarta-cardiovascular', [JakartaCardiovascularController::class, 'update'])->middleware('auth');
Route::get('/delete-score-jakarta-cardiovascular/{no_rawat}', [JakartaCardiovascularController::class, 'destroy'])->middleware('auth');

Route::get('/score-pemeriksaan-napfa', [ScorePemeriksaanController::class, 'index'])->middleware('auth');
Route::post('/score-pemeriksaan-napfa', [ScorePemeriksaanController::class, 'show'])->middleware('auth');
Route::get('/detail-score-pemeriksaan-napfa/{no_rawat}', [NapfaController::class, 'index'])->middleware('auth');
Route::get('/get-score-pemeriksaan-napfa/{no_rawat}', [NapfaController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-score-pemeriksaan-napfa', [NapfaController::class, 'store'])->middleware('auth');
Route::post('/update-score-pemeriksaan-napfa', [NapfaController::class, 'update'])->middleware('auth');
Route::get('/delete-score-pemeriksaan-napfa/{no_rawat}', [NapfaController::class, 'destroy'])->middleware('auth');