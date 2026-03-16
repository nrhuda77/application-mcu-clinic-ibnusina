<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanMcu\Http\Controllers\LaporanMcuController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('laporanmcus', LaporanMcuController::class)->names('laporanmcu');
});
