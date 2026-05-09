<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('peminjams', PeminjamController::class);
    Route::resource('ruangs', RuangController::class);
    Route::resource('peralatans', PeralatanController::class);
    Route::resource('peminjamans', PeminjamanController::class);

    Route::patch('/peminjamans/{peminjaman}/status', [PeminjamanController::class, 'updateStatus'])
        ->name('peminjamans.updateStatus');

    Route::get('/reports/peminjaman/csv', [ReportController::class, 'exportPeminjamanCsv'])
        ->name('reports.peminjaman.csv');
});