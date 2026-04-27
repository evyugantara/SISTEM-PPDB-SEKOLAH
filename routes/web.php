<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\KepsekController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/daftar', [FrontController::class, 'daftar'])->name('public.daftar');
Route::post('/daftar', [FrontController::class, 'storePendaftaran'])->name('public.storePendaftaran');
Route::post('/cek-status', [FrontController::class, 'cekStatus'])->name('cek-status');
Route::get('/cetak-bukti/{nisn}', [FrontController::class, 'cetakBukti'])->name('public.cetak');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::middleware('role:Admin')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'store'])->name('settings.store');
        Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::middleware('role:Panitia')->prefix('panitia')->group(function () {
        Route::get('/', [PanitiaController::class, 'dashboard'])->name('panitia.dashboard');
    });

    Route::middleware('role:Kepala Sekolah')->prefix('kepsek')->group(function () {
        Route::get('/', [KepsekController::class, 'dashboard'])->name('kepsek.dashboard');
    });

    Route::prefix('manage')->group(function () {

        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::get('students/create', [StudentController::class, 'create'])->name('students.create')->middleware('role:Admin,Panitia');
        Route::post('students', [StudentController::class, 'store'])->name('students.store')->middleware('role:Admin,Panitia');
        Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit')->middleware('role:Admin,Panitia');
        Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update')->middleware('role:Admin,Panitia');
        Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');

        Route::get('hasil', [StudentController::class, 'hasil'])->name('students.hasil');
        Route::get('export/excel', [StudentController::class, 'exportExcel'])->name('students.exportExcel');
        Route::get('cetak-semua', [StudentController::class, 'cetakSemua'])->name('students.cetakSemua');
        Route::get('cetak/{student}', [StudentController::class, 'cetak'])->name('students.cetak');

        Route::get('logs', [LogController::class, 'index'])->name('logs.index')->middleware('role:Admin,Kepala Sekolah');
    });
});


