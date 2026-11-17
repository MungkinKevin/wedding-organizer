<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Mengambil data booking utama untuk halaman dashboard
        $bookings = Booking::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // 2. Mengambil data untuk notifikasi dropdown
        $notifications = Booking::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // 3. Kirim $bookings DAN $notifications sekaligus ke view
        return view('user.dashboard', compact('bookings', 'notifications'));
    }
}