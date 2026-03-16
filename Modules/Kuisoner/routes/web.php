<?php

use Illuminate\Support\Facades\Route;
use Modules\Kuisoner\Http\Controllers\Imunisasi\RiwayatImunisasiController;
use Modules\Kuisoner\Http\Controllers\Kebiasaan\RiwayatKebiasaanController;
use Modules\Kuisoner\Http\Controllers\Kesehatan\RiwayatKesehatanController;
use Modules\Kuisoner\Http\Controllers\KuisonerController;
use Modules\Kuisoner\Http\Controllers\Paparan\RiwayatPaparanController;
use Modules\Kuisoner\Http\Controllers\Penyakitkeluarga\RiwayatPenyakitKeluargaController;

Route::get('/riwayat-kesehatan', [KuisonerController::class, 'index'])->middleware('auth');
Route::post('/riwayat-kesehatan', [KuisonerController::class, 'show'])->middleware('auth');
Route::get('/detail-riwayat-kesehatan/{no_rawat}', [RiwayatKesehatanController::class, 'index'])->middleware('auth');
Route::get('/get-riwayat-kesehatan/{no_rawat}', [RiwayatKesehatanController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-riwayat-kesehatan', [RiwayatKesehatanController::class, 'store'])->middleware('auth');
Route::post('/update-riwayat-kesehatan', [RiwayatKesehatanController::class, 'update'])->middleware('auth');
Route::get('/delete-riwayat-kesehatan/{no_rawat}', [RiwayatKesehatanController::class, 'destroy'])->middleware('auth');

Route::get('/riwayat-penyakit-keluarga', [KuisonerController::class, 'index'])->middleware('auth');
Route::post('/riwayat-penyakit-keluarga', [KuisonerController::class, 'show'])->middleware('auth');
Route::get('/detail-riwayat-penyakit-keluarga/{no_rawat}', [RiwayatPenyakitKeluargaController::class, 'index'])->middleware('auth');
Route::get('/get-riwayat-penyakit-keluarga/{no_rawat}', [RiwayatPenyakitKeluargaController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-riwayat-penyakit-keluarga', [RiwayatPenyakitKeluargaController::class, 'store'])->middleware('auth');
Route::post('/update-riwayat-penyakit-keluarga', [RiwayatPenyakitKeluargaController::class, 'update'])->middleware('auth');
Route::get('/delete-riwayat-penyakit-keluarga/{no_rawat}', [RiwayatPenyakitKeluargaController::class, 'destroy'])->middleware('auth');

Route::get('/riwayat-paparan', [KuisonerController::class, 'index'])->middleware('auth');
Route::post('/riwayat-paparan', [KuisonerController::class, 'show'])->middleware('auth');
Route::get('/detail-riwayat-paparan/{no_rawat}', [RiwayatPaparanController::class, 'index'])->middleware('auth');
Route::get('/get-riwayat-paparan/{no_rawat}', [RiwayatPaparanController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-riwayat-paparan', [RiwayatPaparanController::class, 'store'])->middleware('auth');
Route::post('/update-riwayat-paparan', [RiwayatPaparanController::class, 'update'])->middleware('auth');
Route::get('/delete-riwayat-paparan/{no_rawat}', [RiwayatPaparanController::class, 'destroy'])->middleware('auth');

Route::get('/riwayat-imunisasi', [KuisonerController::class, 'index'])->middleware('auth');
Route::post('/riwayat-imunisasi', [KuisonerController::class, 'show'])->middleware('auth');
Route::get('/detail-riwayat-imunisasi/{no_rawat}', [RiwayatImunisasiController::class, 'index'])->middleware('auth');
Route::get('/get-riwayat-imunisasi/{no_rawat}', [RiwayatImunisasiController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-riwayat-imunisasi', [RiwayatImunisasiController::class, 'store'])->middleware('auth');
Route::post('/update-riwayat-imunisasi', [RiwayatImunisasiController::class, 'update'])->middleware('auth');
Route::get('/delete-riwayat-imunisasi/{no_rawat}', [RiwayatImunisasiController::class, 'destroy'])->middleware('auth');

Route::get('/riwayat-kebiasaan', [KuisonerController::class, 'index'])->middleware('auth');
Route::post('/riwayat-kebiasaan', [KuisonerController::class, 'show'])->middleware('auth');
Route::get('/detail-riwayat-kebiasaan/{no_rawat}', [RiwayatKebiasaanController::class, 'index'])->middleware('auth');
Route::get('/get-riwayat-kebiasaan/{no_rawat}', [RiwayatKebiasaanController::class, 'ajax_data'])->middleware('auth');
Route::post('/insert-riwayat-kebiasaan', [RiwayatKebiasaanController::class, 'store'])->middleware('auth');
Route::post('/update-riwayat-kebiasaan', [RiwayatKebiasaanController::class, 'update'])->middleware('auth');
Route::get('/delete-riwayat-kebiasaan/{no_rawat}', [RiwayatKebiasaanController::class, 'destroy'])->middleware('auth');

Route::get('/kuisoner', [KuisonerController::class, 'pasien'])->middleware('auth:pasien');