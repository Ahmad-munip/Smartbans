<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\AhpController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes - accessible by ALL logged-in users
Route::middleware('auth')->prefix('dashboard')->group(function () {
    // Dashboard (accessible by all roles)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Data Warga CRUD (accessible by all roles)
    Route::resource('warga', WargaController::class);

    // Kriteria & Sub-Kriteria READ - accessible by all roles (admin, petugas, operator)
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('sub-kriteria', [SubKriteriaController::class, 'index'])->name('sub-kriteria.index');

    // AHP & TOPSIS Viewers (accessible by all roles)
    Route::get('ahp', [AhpController::class, 'index'])->name('ahp.index');
    Route::get('topsis', [TopsisController::class, 'index'])->name('topsis.index');
    Route::get('topsis/detail/{id}', [TopsisController::class, 'detailMath'])->name('topsis.detail');

    // Laporan & Export (accessible by all roles)
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('laporan/excel', [LaporanController::class, 'excel'])->name('laporan.excel');

    // Write operations - restricted to admin & petugas only
    Route::middleware('role:admin,petugas')->group(function () {
        // Kriteria CRUD (write operations only)
        Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        Route::put('kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::patch('kriteria/{kriteria}', [KriteriaController::class, 'update']);
        Route::delete('kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

        // Sub-Kriteria CRUD (write operations only)
        Route::get('sub-kriteria/create', [SubKriteriaController::class, 'create'])->name('sub-kriteria.create');
        Route::post('sub-kriteria', [SubKriteriaController::class, 'store'])->name('sub-kriteria.store');
        Route::get('sub-kriteria/{sub_kriteria}/edit', [SubKriteriaController::class, 'edit'])->name('sub-kriteria.edit');
        Route::put('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'update'])->name('sub-kriteria.update');
        Route::patch('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'update']);
        Route::delete('sub-kriteria/{sub_kriteria}', [SubKriteriaController::class, 'destroy'])->name('sub-kriteria.destroy');

        // AHP & TOPSIS Calculations
        Route::post('ahp', [AhpController::class, 'calculate'])->name('ahp.calculate');
        Route::post('topsis/calculate', [TopsisController::class, 'calculate'])->name('topsis.calculate');
    });
});



