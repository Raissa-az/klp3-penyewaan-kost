<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Penyewa\KostController as PenyewaKostController;
use App\Http\Controllers\Penyewa\PenyewaController;
use App\Http\Controllers\Penyewa\BookingController as PenyewaBookingController;
use App\Http\Controllers\Penyewa\KamarController as PenyewaKamarController;
use App\Http\Controllers\Penyewa\PenyewaSettingController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminKostController;
use App\Http\Controllers\Admin\AdminKamarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\SettingController;


// Redirect default
Route::get('/', fn() => redirect()->route('login'));


// =====================
// AUTH (Guest Only)
// =====================
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
});


// =====================
// LOGOUT
// =====================
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// =====================
// PENYEWA
// =====================
Route::prefix('penyewa')
    ->name('penyewa.')
    ->middleware(['auth','role:penyewa'])
    ->group(function () {

    Route::get('/dashboard', [PenyewaController::class, 'index'])->name('dashboard');

    // Cari Kost
    Route::get('/cari-kost', [PenyewaKostController::class, 'index'])->name('cari-kost');

    // Kost berdasarkan tipe (cewe/cowo/campur)
    Route::get('/kost/tipe/{tipe}', [PenyewaKostController::class, 'showByType'])
        ->name('kost.tipe')
        ->where('tipe', 'cewe|cowo|campur');

    // detail lengkap 1 kost → harus di atas
    Route::get('/kost/{id}/detail', [PenyewaKostController::class, 'showDetail'])
        ->name('kost.detail');

    // detail kost biasa
    Route::get('/kost/{id}', [PenyewaKostController::class, 'show'])
        ->name('kost.show');

    // Booking
    Route::get('/booking', [PenyewaBookingController::class, 'index'])->name('booking');
    Route::post('/booking/store', [PenyewaBookingController::class, 'store'])->name('booking.store');

    // Booking via WA
    Route::post('/booking/whatsapp', [PenyewaBookingController::class, 'redirectToWhatsApp'])
        ->name('booking.whatsapp');

    // Booking dari halaman kamar detail
    Route::get('/kamar/{id}/booking', [PenyewaBookingController::class, 'booking'])
        ->name('kamar.booking');

    // List kamar
    Route::get('/kamar', [PenyewaKamarController::class, 'penyewaView'])->name('kamar');

    // Settings
    Route::get('/settings', [PenyewaSettingController::class, 'index'])->name('settings');
});
 // ← WAJIB! Penutup group penyewa


// =====================
// ADMIN
// =====================
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('kost', AdminKostController::class);

    Route::resource('kamar', AdminKamarController::class);
    Route::post('/kamar/{id}/status', [AdminKamarController::class, 'updateStatus'])->name('kamar.updateStatus');

    // Booking Routes
Route::get('/booking', [AdminBookingController::class, 'index'])->name('booking.index');
Route::post('/booking/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('booking.updateStatus');
Route::delete('/booking/{id}', [AdminBookingController::class, 'destroy'])->name('booking.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
});


// Fallback
Route::fallback(fn() => redirect()->route('login')->with('error', 'Halaman tidak ditemukan.'));
