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
        $validated = $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'contact_address' => 'required|string|max:1000',
            'tanggal_acara' => 'required|date|after_or_equal:today',
            'waktu_acara' => 'required|date_format:H:i',
            'event_location' => 'nullable|string|max:150',
            'event_address' => 'required|string|max:1000',
            'catatan' => 'nullable|string|max:3000',
        ]);

        $paket = Paket::findOrFail($id);

        Booking::create([
            'user_id' => auth()->id(),
            'paket_id' => $paket->id,
            'event_date' => $validated['tanggal_acara'],
            'notes' => $validated['catatan'] ?? null,
            'final_price' => $paket->price,
            'bride_name' => $validated['bride_name'],
            'groom_name' => $validated['groom_name'],

            // Mengambil nomor HP dari tabel users
            'contact_phone' => auth()->user()->phone,

            'contact_address' => $validated['contact_address'],
            'event_time' => $validated['waktu_acara'],
            'event_location' => $validated['event_location'] ?? null,
            'event_address' => $validated['event_address'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Booking berhasil dikirim!');
    }
}