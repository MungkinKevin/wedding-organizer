<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;

Auth::routes();

// bisa diakses SEMUA user yang sudah login

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// untuk ADMIN 
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

    Route::resource('admin/paket', PaketController::class)
        ->except(['show'])
        ->names('admin.paket');
});


Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile');
Route::get('/', function () {
    return view('landing.index');
});
