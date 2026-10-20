<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;


Auth::routes();

// bisa diakses SEMUA user yang sudah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// untuk ADMIN 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Selamat Datang di Dashboard Admin Satria Wedding Organizer!';
    });
});


Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile');
Route::get('/', function () {
    return view('landing.index');
});
