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

// ========================
// AUTHENTICATION
// ========================
Auth::routes();

// ========================
// LANDING PAGE
// ========================
Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

// ========================
// REDIRECT HOME BERDASARKAN ROLE
// ========================
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

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Kelola Paket
    Route::resource('admin/paket', PaketController::class)
        ->except(['show'])
        ->names('admin.paket');

    // Kelola Booking
    Route::get('/admin/booking', [AdminBookingController::class, 'index'])
        ->name('admin.booking.index');

    Route::get('/admin/booking/{booking}/edit', [AdminBookingController::class, 'edit'])
        ->name('admin.booking.edit');

    Route::patch('/admin/booking/{booking}', [AdminBookingController::class, 'update'])
        ->name('admin.booking.update');

    Route::patch('/admin/booking/{booking}/details', [AdminBookingController::class, 'updateDetails'])
        ->name('admin.booking.updateDetails');

        Route::patch('/admin/booking/{booking}/status', [AdminBookingController::class, 'updateStatus'])
    ->name('admin.booking.updateStatus');

    // Kelola Testimoni
    Route::resource('admin/testimoni', AdminTestimoniController::class)
        ->except(['show'])
        ->names('admin.testimoni');

    // Kelola Galeri
    Route::resource('admin/galeri', AdminGaleriController::class)
        ->except(['show'])
        ->names('admin.galeri');

    // Laporan
    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])
        ->name('admin.laporan.index');
});

// ========================
// USER ROUTES
// ========================
Route::middleware(['auth'])->group(function () {

    // Dashboard User
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // Profil User
    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    // Update Profil
    Route::post('/user/profile/update', [UserProfileController::class, 'update'])
        ->name('user.profile.update');

    // Update Foto Profil
    Route::post('/user/profile/photo', [UserProfileController::class, 'updatePhoto'])
        ->name('user.profile.photo');

    // Update Password
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
Route::middleware(['auth'])->group(function () {

    Route::get('/booking/{id}', [BookingController::class, 'create'])
        ->name('landing.booking.create');

    Route::post('/booking/{id}', [BookingController::class, 'store'])
        ->name('landing.booking.store');

    // Alias untuk kompatibilitas route booking.store
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');
});
