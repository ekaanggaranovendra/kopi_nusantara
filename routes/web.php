<?php

use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PemesananController::class, 'index'])->name('home');
Route::post('/pesan', [PemesananController::class, 'store'])->name('pesanan.store');
Route::get('/health', [PemesananController::class, 'health'])->name('health');
