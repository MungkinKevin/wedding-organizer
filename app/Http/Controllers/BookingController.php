<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create($id)
    {
        $paket = Paket::findOrFail($id);

        return view('landing.booking', compact('paket'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal_acara' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string',
        ]);

        $paket = Paket::findOrFail($id);

        Booking::create([
            'user_id' => auth()->id(),
            'paket_id' => $paket->id,
            'event_date' => $request->tanggal_acara,
            'notes' => $request->catatan,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Booking berhasil dikirim!');
    }
}