<?php

use App\Http\Controllers\DivisiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin|hr'])->group(function () {
    Route::resource('divisi', DivisiController::class);
    Route::resource('posisi', PosisiController::class);
    Route::resource('user', UserController::class);
});

Route::middleware(['auth', 'role:admin|hr|manager'])->group(function () {
    Route::get('divisi/{divisi}/posisi', [PosisiController::class, 'byDivisi'])->name('divisi.posisi');

    Route::resource('karyawan', KaryawanController::class);
});

Route::middleware(['auth', 'role:admin|hr|manager|karyawan'])->group(function () {
    Route::resource('kehadiran', KehadiranController::class);
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::post('/check-in', [KehadiranController::class, 'checkIn'])
        ->name('kehadiran.checkin');

    Route::post('/check-out', [KehadiranController::class, 'checkOut'])
        ->name('kehadiran.checkout');
});

require __DIR__.'/auth.php';
