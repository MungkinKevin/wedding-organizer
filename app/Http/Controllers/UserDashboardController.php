<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Mengambil data booking milik user yang sedang login beserta data paketnya
        $bookings = Booking::with('paket')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Mengirim data bookings ke view user.dashboard
        return view('user.dashboard', compact('bookings'));
    }
}