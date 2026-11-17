<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    // Menampilkan riwayat booking
    public function index()
    {
        $userId = Auth::id();

        $bookings = Booking::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // Ambil data untuk notifikasi dropdown
        $notifications = Booking::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('user.booking.riwayat', compact('bookings', 'notifications'));
    }

    // Menampilkan form untuk membuat booking baru
    public function create()
    {
        $userId = Auth::id();
        $pakets = Paket::all();

        // Ambil data untuk notifikasi dropdown di halaman form juga
        $notifications = Booking::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('user.booking.create', compact('pakets', 'notifications'));
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