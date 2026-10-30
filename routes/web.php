<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserBookingController;

Auth::routes();

// bisa diakses SEMUA user yang sudah login
Route::get('/home', function () {
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('home');

// untuk ADMIN 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
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