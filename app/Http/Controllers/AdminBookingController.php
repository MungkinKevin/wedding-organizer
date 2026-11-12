<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Validation\Rule;

class AdminBookingController extends Controller
{
    public function index() {
        
        $bookings = Booking::with(['user', 'paket'])
            ->latest()
            ->paginate(10);

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
            'notes' => 'nullable|string',
            'final_price' => 'nullable|numeric|min:0',
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'diproses',
                    'dikonfirmasi',
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