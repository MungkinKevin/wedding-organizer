<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Booking;

class BookingController extends Controller
{
    // Menampilkan form booking berdasarkan paket
    public function create($id)
    {
        $paket = Paket::findOrFail($id);

        return view('landing.booking', compact('paket'));
    }

    // Menyimpan data booking
    public function store(Request $request, $id)
    {
        $request->validate([
            'event_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        $paket = Paket::findOrFail($id);

        Booking::create([
            'user_id' => auth()->id(),
            'paket_id' => $paket->id,
            'event_date' => $request->event_date,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Booking berhasil dikirim!');
    }
}
