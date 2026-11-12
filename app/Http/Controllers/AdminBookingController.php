<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use App\Mail\BookingStatusNotification; // Jangan lupa tambahkan use ini di bagian atas file
use Illuminate\Support\Facades\Mail;    // Dan use Mail ini

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

<<<<<<< HEAD
        $booking->update($validated);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Data booking berhasil diperbarui.');
=======
        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function updateDetails(Request $request, Booking $booking) {

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'final_price' => 'nullable|numeric|min:0',
        ]);

        $booking->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Status booking berhasil diperbarui.');
>>>>>>> origin/feature/auth-user-dashboard
    }
}