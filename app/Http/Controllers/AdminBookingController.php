<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Validation\Rule;

class AdminBookingController extends Controller
{
    public function index() {
        
        $bookings = Booking::with(['user', 'paket'])
            ->orderByRaw("
            CASE status
                WHEN 'pending' THEN 1
                WHEN 'dikonfirmasi' THEN 2
                WHEN 'diproses' THEN 3
                WHEN 'selesai' THEN 4
                WHEN 'dibatalkan' THEN 5
                ELSE 6
            END")
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $totalBooking = Booking::count();

        $bookingPending = Booking::where('status', 'pending')
            ->count();

        return view('admin.booking.index', compact(
            'bookings',
            'totalBooking',
            'bookingPending'
        ));
    }



    public function edit(Booking $booking)
    {
        $booking->load(['user', 'paket']);

        return view('admin.booking.edit', compact('booking'));
    }

    // Menyimpan perubahan booking
    public function update(Request $request, Booking $booking) {
        $validated = $request->validate([
            'bride_name' => 'nullable|string|max:255',
            'groom_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'final_price' => 'nullable|numeric|min:0',
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'dikonfirmasi',
                    'diproses',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Data booking berhasil diperbarui.');
    }
}