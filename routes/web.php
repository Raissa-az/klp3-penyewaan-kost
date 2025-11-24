<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

// Default redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.process');
});

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// PENYEWA ROUTES
Route::middleware(['auth', 'role:penyewa'])
    ->prefix('penyewa')
    ->name('penyewa.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('penyewa.dashboard'))->name('dashboard');
        Route::get('/cari-kost', fn() => view('penyewa.cari-kost'))->name('cari-kost');
        Route::get('/kost/{id}', fn() => view('penyewa.detail'))->name('detail');
        Route::get('/booking', fn() => view('penyewa.booking'))->name('booking');
        Route::get('/pengaturan', fn() => view('penyewa.pengaturan'))->name('pengaturan');
    });


// ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        Route::get('/kamar', fn() => view('admin.kamar.index'))->name('kamar.index');
        Route::get('/kamar/create', fn() => view('admin.kamar.create'))->name('kamar.create');
        Route::get('/kamar/{id}/edit', fn() => view('admin.kamar.edit'))->name('kamar.edit');

        Route::get('/booking', fn() => view('admin.booking.index'))->name('booking.index');
    });


// Fallback
Route::fallback(function () {
    return redirect()->route('login')->with('error', 'Halaman tidak ditemukan.');
});
