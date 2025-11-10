<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SatkerController;
use App\Http\Controllers\DantonController;
use App\Http\Controllers\PamenwasController;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
    return view('error.page_not_found');
});

Route::get('/', [AuthController::class, 'home']);
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth', 'role:ADMIN_SATKER'])->group(function () {
        Route::get('/satker', [SatkerController::class, 'index'])->name('satker');
        Route::get('/satker/anggota', [SatkerController::class, 'anggota'])->name('satker.anggota');
        Route::post('/satker/anggota/store', [SatkerController::class, 'store'])->name('satker.anggota.store');
        Route::post('/satker/anggota/update', [SatkerController::class, 'update'])->name('satker.anggota.update');
        Route::post('/satker/anggota/pindah', [SatkerController::class, 'pindah'])->name('satker.anggota.pindah');
        Route::get('/satker/riwayat', [SatkerController::class, 'riwayat'])->name('satker.riwayat');
        Route::get('/satker/riwayat/detail', [SatkerController::class, 'riwayat_detail'])->name('satker.riwayat.detail');
    });

    Route::middleware(['auth', 'role:DANTON'])->group(function () {
        Route::get('/danton', [DantonController::class, 'index'])->name('danton');
        Route::post('/danton/store', [DantonController::class, 'store'])->name('danton.store');
        Route::get('/danton/riwayat', [DantonController::class, 'riwayat'])->name('danton.riwayat');
        Route::get('/danton/riwayat/detail', [DantonController::class, 'riwayat_detail'])->name('danton.riwayat.detail');
    });

    Route::middleware(['auth', 'role:PAMENWAS'])->group(function () {
        Route::get('/pamenwas', [PamenwasController::class, 'index'])->name('pamenwas');
        Route::get('/pamenwas/riwayat/{id}', [PamenwasController::class, 'riwayat'])->name('pamenwas.riwayat');
        Route::get('/pamenwas/riwayat_detail', [PamenwasController::class, 'riwayat_detail'])->name('pamenwas.riwayat.detail');
        Route::get('/pamenwas/riwayat_semua', [PamenwasController::class, 'riwayat_semua'])->name('pamenwas.riwayat.semua');
        Route::get('/pamenwas/riwayat_semua_detail', [PamenwasController::class, 'riwayat_semua_detail'])->name('pamenwas.riwayat.semua.detail');
        Route::get('/pamenwas/rekap', [PamenwasController::class, 'rekap'])->name('pamenwas.rekap');
        Route::get('/pamenwas/rekap/print', [PamenwasController::class, 'print'])->name('pamenwas.rekap.print');
    });

    Route::middleware(['auth', 'role:SUPER_ADMIN'])->group(function () {
        Route::get('/superadmin', [SuperadminController::class, 'index'])->name('superadmin');
        Route::post('/superadmin/user/store', [SuperadminController::class, 'store'])->name('superadmin.user.store');
        Route::post('/superadmin/user/update', [SuperadminController::class, 'update'])->name('superadmin.user.update');
        Route::get('/superadmin/anggota', [SuperadminController::class, 'anggota'])->name('superadmin.anggota');
        Route::get('/superadmin/satker', [SuperadminController::class, 'satker'])->name('superadmin.satker');
    });
});
