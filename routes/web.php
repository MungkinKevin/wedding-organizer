<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminTestimoniController;
use App\Http\Controllers\AdminGaleriController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserBookingController;

// Authentication
Auth::routes();

// Landing Page
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

// Redirect /home berdasarkan role
Route::get('/home', function () {
    $user = Auth::user();

    if ($user && $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('home');

// ========================
// ADMIN ROUTES
// ========================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::resource('admin/paket', PaketController::class)
        ->except(['show'])
        ->names('admin.paket');

    Route::get('/admin/booking', [AdminBookingController::class, 'index'])
        ->name('admin.booking.index');

    Route::get('/admin/booking/{booking}/edit', [
    AdminBookingController::class,
    'edit'
    ])->name('admin.booking.edit');

    Route::patch('/admin/booking/{booking}', [
        AdminBookingController::class,
        'update'
    ])->name('admin.booking.update');

    Route::patch('/admin/booking/{booking}/details', [
    AdminBookingController::class,
    'updateDetails'
    ])->name('admin.booking.updateDetails');

    Route::resource('admin/testimoni', AdminTestimoniController::class)
        ->except(['show'])
        ->names('admin.testimoni');

    Route::resource('admin/galeri', AdminGaleriController::class)
        ->except(['show'])
        ->names('admin.galeri');

    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])
    ->name('admin.laporan.index');
});

// ========================
// USER ROUTES
// ========================
Route::middleware(['auth'])->group(function () {

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    // Update profil
    Route::post('/user/profile/update', [UserProfileController::class, 'update'])
        ->name('user.profile.update');

    // Update foto profil
    Route::post('/user/profile/photo', [UserProfileController::class, 'updatePhoto'])
        ->name('user.profile.photo');

    // Update password
    Route::put('/user/password', [UserProfileController::class, 'updatePassword'])
        ->name('password.update');
});

// ========================
// USER BOOKING
// ========================
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('/booking', [UserBookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/create', [UserBookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [UserBookingController::class, 'store'])
        ->name('booking.store');
});

// ========================
// BOOKING DARI LANDING PAGE
// ========================
// BOOKING FROM LANDING PAGE
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/{id}', [BookingController::class, 'create'])
        ->name('landing.booking.create');

    Route::post('/booking/{id}', [BookingController::class, 'store'])
        ->name('landing.booking.store');
});
