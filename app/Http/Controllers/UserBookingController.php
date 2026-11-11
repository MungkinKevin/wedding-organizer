<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    // Menampilkan riwayat booking (mengarah ke riwayat.blade.php)
    public function index()
    {
        $bookings = Booking::with('paket')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.booking.riwayat', compact('bookings'));
    }

    // Menampilkan form untuk membuat booking baru
    public function create()
    {
        $pakets = Paket::all();
        return view('user.booking.create', compact('pakets'));
    }

    // Menyimpan data booking baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:paket,id',
            'event_date' => 'required|date|after:today',
            'notes' => 'nullable|string',
        ]);

        $paket = Paket::findOrFail($request->paket_id);

        Booking::create([
            'user_id' => Auth::id(),
            'paket_id' => $request->paket_id,
            'event_date' => $request->event_date,
            'notes' => $request->notes,
            'final_price' => $paket->price,
            'status' => 'pending',
        ]);

        return redirect()->route('user.booking.index')->with('success', 'Booking berhasil diajukan! Silakan tunggu konfirmasi.');
    }
}