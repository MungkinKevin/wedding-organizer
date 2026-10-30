<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminTestimoniController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\UserPasswordController;
use App\Http\Controllers\UserTestimoniController;
use App\Http\Controllers\LandingController;
Auth::routes();

// Redirect /home berdasarkan role user
Route::get('/home', function () {
    $user = Auth::user();
    
    // Cek jika role-nya admin
    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Jika user biasa
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('home');

// untuk ADMIN 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Fitur paket dari temanmu digabungkan di sini agar tidak hilang
    Route::resource('admin/paket', PaketController::class)
        ->except(['show'])
        ->names('admin.paket');

    Route::get('/admin/booking', [AdminBookingController::class, 'index'])
        ->name('admin.booking.index');
    
    Route::patch('/admin/booking/{booking}/status', [
        AdminBookingController::class,
        'updateStatus'
    ])->name('admin.booking.updateStatus');

    Route::resource('admin/testimoni', AdminTestimoniController::class)
        ->except(['show'])
        ->names('admin.testimoni');
});

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile');
Route::get('/', function () {
    return view('landing.index');
});

// Route untuk memperbarui data profil
Route::post('/user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
Route::post('/user/profile/photo', [App\Http\Controllers\UserProfileController::class, 'updatePhoto'])->name('user.profile.photo');

// Rute untuk Booking User
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/booking', [UserBookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create', [UserBookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [UserBookingController::class, 'store'])->name('booking.store');
});

// Rute untuk mengubah kata sandi
Route::put('/user/password', [UserProfileController::class, 'updatePassword'])->name('password.update');