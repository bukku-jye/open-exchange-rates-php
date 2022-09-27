<?php

use BukkuAccounting\OpenExchangeRatesSdk\Controllers\oerSdkController;
use Illuminate\Support\Facades\Route;

Route::prefix('/oer')->group(function() {
    Route::get('/latest', [oerSdkController::class, 'latest']);
    Route::get('/historical', [oerSdkController::class, 'historical']);
    Route::get('/currencies', [oerSdkController::class, 'currencies']);
    Route::get('/time-series', [oerSdkController::class, 'time_series']);
    Route::get('/convert', [oerSdkController::class, 'convert']);
    Route::get('/ohlc', [oerSdkController::class, 'ohlc']);
    Route::get('/usage', [oerSdkController::class, 'usage']);
});