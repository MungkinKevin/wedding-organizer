<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Testimoni;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPaket = Paket::count();

        $totalBooking = \App\Models\Booking::count();

        $totalPendingBooking = \App\Models\Booking::where('status', 'pending')->count();

        $totalTestimoni = Testimoni::count();
        
        return view('admin.dashboard', compact(
            'totalPaket',
            'totalBooking',
            'totalPendingBooking',
            'totalTestimoni'
        ));
    }
}
