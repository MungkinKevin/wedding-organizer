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

    public function updateStatus(Request $request, Booking $booking) {

        $validated = $request->validate([
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

        $booking->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    public function updateDetails(Request $request, Booking $booking) {

        $validated = $request->validate([
            'notes' => 'nullable|string',
            'final_price' => 'nullable|numeric|min:0',
        ]);

        $booking->update($validated);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Detail booking berhasil diperbarui.');
    }
}