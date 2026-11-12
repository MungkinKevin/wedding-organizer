<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use App\Mail\BookingStatusNotification;
use Illuminate\Support\Facades\Mail;

class AdminBookingController extends Controller
{
    public function index()
    {
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

    // Memperbarui status, catatan, dan harga booking
    public function update(Request $request, Booking $booking)
    {
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

        $oldStatus = $booking->status;

        $booking->update($validated);

        // Kirim notifikasi jika status berubah
        if ($oldStatus !== $booking->status && $booking->user) {
            Mail::to($booking->user->email)
                ->send(new BookingStatusNotification($booking));
        }

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Data booking berhasil diperbarui.');
    }

    // Memperbarui catatan dan harga final secara terpisah
    public function updateDetails(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string',
            'final_price' => 'nullable|numeric|min:0',
        ]);

        $booking->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Detail booking berhasil diperbarui.');
    }
}
