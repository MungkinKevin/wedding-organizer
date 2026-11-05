<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Testimoni;
use App\Models\Booking;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPaket = Paket::count();

        $totalBooking = Booking::count();

        $totalPendingBooking = Booking::where('status', 'pending')->count();

        $totalTestimoni = Testimoni::count();

        $bookingsAktif = Booking::with(['user', 'paket'])
            ->whereIn('status', ['pending', 'diproses', 'dikonfirmasi'])
            ->latest()
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalPaket',
            'totalBooking',
            'totalPendingBooking',
            'totalTestimoni',
            'bookingsAktif'
        ));
    }
}
