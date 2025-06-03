<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () {
    return view('main');
});

Route::prefix('pendaftaran')->group(function () {
    Route::get('/', [PendaftaranController::class, 'showForm'])->name('pendaftaran.form');
    Route::post('/data-santri', [PendaftaranController::class, 'storeDataSantri'])->name('pendaftaran.santri');
    Route::post('/data-ortu', [PendaftaranController::class, 'storeDataOrtu'])->name('pendaftaran.ortu');
    Route::post('/berkas', [PendaftaranController::class, 'storeBerkas'])->name('pendaftaran.berkas');
    Route::get('/summary', [PendaftaranController::class, 'getSummary'])->name('pendaftaran.summary');
    Route::post('/submit', [PendaftaranController::class, 'submitPendaftaran'])->name('pendaftaran.submit');
});

Route::get('/pembayaran/{id}', [PendaftaranController::class, 'showPembayaran'])->name('pembayaran');
Route::post('/pembayaran/{id}/upload', [PendaftaranController::class, 'uploadBuktiBayar'])->name('pembayaran.upload');