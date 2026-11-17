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
            ->orderByRaw("
                CASE LOWER(TRIM(status))
                    WHEN 'pending' THEN 1
                    WHEN 'dikonfirmasi' THEN 2
                    WHEN 'diproses' THEN 3
                    WHEN 'selesai' THEN 4
                    WHEN 'dibatalkan' THEN 5
                    ELSE 6
                END ASC
            ")
            ->orderBy('event_date', 'asc')
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

    // Memperbarui status, catatan, dan harga booking
    public function update(Request $request, Booking $booking)
    {
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

        $oldStatus = $booking->status;

        $booking->update($validated);

        // Kirim email jika status berubah
        if ($oldStatus !== $booking->status && $booking->user && $booking->user->email) {
            try {
                Mail::to($booking->user->email)
                    ->send(new BookingStatusNotification($booking));
            } catch (\Exception $e) {
                \Log::error('Gagal mengirim email status booking: ' . $e->getMessage());
            }
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
