<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

// Default redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');


//boooking
Route::middleware(['auth', 'role:penyewa'])->prefix('penyewa')->name('penyewa.')->group(function () {

    // Halaman detail kost
    Route::get('/kost/{id}', [App\Http\Controllers\Penyewa\KostController::class, 'detail'])
        ->name('detail');

    // Store booking
    Route::post('/booking/store', [App\Http\Controllers\Penyewa\BookingController::class, 'store'])
        ->name('booking.store');

});

///penyewa
Route::middleware(['auth', 'role:penyewa'])
    ->prefix('penyewa')
    ->name('penyewa.')
    ->group(function () {
        Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    });


    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

    // Tambahkan route UPDATE STATUS
    Route::put('/booking/{id}/update-status', [BookingController::class, 'updateStatus'])
        ->name('booking.update-status');

});

Route::middleware(['auth', 'role:penyewa'])->group(function () {

    Route::get('/penyewa/dashboard', [PenyewaController::class, 'index'])
        ->name('penyewa.dashboard');

    Route::get('/penyewa/booking', [BookingController::class, 'index'])
        ->name('penyewa.booking');

    Route::get('/penyewa/kamar', [KamarController::class, 'penyewaView'])
        ->name('penyewa.kamar');

    Route::get('/penyewa/settings', [PenyewaSettingController::class, 'index'])
        ->name('penyewa.settings');

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

//sidebar
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

    Route::resource('kamar', KamarController::class);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
});


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
