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

        $totalBookingSelesai = Booking::where('status', 'selesai')->count();

        $totalPendapatan = Booking::where('status', 'selesai')
            ->sum('final_price');

        $bookingsAktif = Booking::with(['user', 'paket'])
            ->whereIn('status', ['pending', 'diproses', 'dikonfirmasi'])
            ->orderBy('event_date', 'asc')
            ->latest('created_at')
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalPaket',
            'totalBooking',
            'totalPendingBooking',
            'totalTestimoni',
            'bookingsAktif',
            'totalBookingSelesai',
            'totalPendapatan'
        ));
    }
}
