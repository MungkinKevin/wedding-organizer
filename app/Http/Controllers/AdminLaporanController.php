<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class AdminLaporanController extends Controller
{
    public function index(Request $request) {
         $validated = $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'nullable|integer|min:2000|max:2100',
        ]);

        // Query seluruh booking sesuai filter tanggal acara
        $query = Booking::with(['user', 'paket']);

        if (!empty($validated['bulan'])) {
            $query->whereMonth('event_date', $validated['bulan']);
        }

        if (!empty($validated['tahun'])) {
            $query->whereYear('event_date', $validated['tahun']);
        }

        // Jumlah seluruh booking sesuai filter
        $totalBooking = (clone $query)->count();

        // Pendapatan hanya dari booking yang sudah selesai
        $totalPendapatan = (clone $query)
            ->where('status', 'selesai')
            ->sum('final_price');

        // Daftar booking untuk ditampilkan pada tabel
        $bookings = $query->orderBy('event_date', 'asc')
            ->paginate(10)
            ->withQueryString();

        // Mengambil daftar tahun yang tersedia di database
        $daftarTahun = Booking::whereNotNull('event_date')
            ->selectRaw('YEAR(event_date) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('admin.laporan.index', compact(
            'bookings',
            'totalBooking',
            'totalPendapatan',
            'daftarTahun'
        ));
    }
}
