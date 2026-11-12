@extends('layouts.app-admin')

@section('title', 'Kelola Booking')

@section('content')
<div class="container-fluid px-0">
    
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Kelola Booking</h3>
        <p class="text-muted mb-0">
            Pantau Pemesanan layanan pernikahan dan status booking pelanggan.
        </p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary">
                        Semua
                    </span>
                </div>
                <div class="text-muted small">Total Booking</div>
                <h3 class="fw-bold mb-0">{{ $totalBooking }}</h3>
                <small class="text-muted">Seluruh pemesanan</small>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning">
                        Pending
                    </span>
                </div>
                <div class="text-muted small">Menunggu Konfirmasi</div>
                <h3 class="fw-bold mb-0">{{ $bookingPending }}</h3>
                <small class="text-muted">Perlu ditinjau admin</small>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="p-3 p-md-4 border-bottom">
                <h5 class="fw-bold mb-1">Daftar Pemesanan</h5>
                <p class="text-muted small mb-0">
                    Data booking yang tersimpan dalam database
                </p>
            </div>

            @if ($bookings->isEmpty())
                <div class="text-center py-5 px-3">
                    <i class="bi bi-calendar-x display-4 text-muted"></i>
                    <h5 class="fw-bold mt-3">Belum ada booking</h5>
                    <p class="text-muted-0 mb-0">
                        Data pemesanan akan muncul disini setelah tersedia.
                    </p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No.</th>
                                <th>Calon Pengantin & Kontak</th>
                                <th>Paket</th>
                                <th>Jadwal & Lokasi</th>
                                <th>Status</th>
                                <th>Catatan Admin</th>
                                <th>Harga Akhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td class="ps-4">
                                        {{ $bookings->firstItem() + $loop->index }}
                                    </td>
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $booking->bride_name && $booking->groom_name
                                                ? $booking->bride_name . ' & ' . $booking->groom_name
                                                : ($booking->user?->name ?? 'Pengguna tidak terdaftar') }}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $booking->user?->email ?? '-'}}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $booking->contact_phone ?? $booking->user?->phone ?? '-' }}
                                        </div>
                                        @if ($booking->contact_address)
                                            <div class="text-muted small mt-1">
                                                Domisili: {{ $booking->contact_address }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $booking->paket?->name ?? 'paket tidak ada'}}
                                        </div>
                                        @if ($booking->paket)
                                            <div class="text-muted small">
                                                Rp {{ number_format($booking->paket->price, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="fw-semibold text-nowrap">
                                            {{ \Carbon\Carbon::parse($booking->event_date)->translatedFormat('d M Y') }}
                                            @if ($booking->event_time)
                                                · {{ \Carbon\Carbon::parse($booking->event_time)->format('H:i') }}
                                            @endif
                                        </div>
                                        @if ($booking->event_location)
                                            <div class="small fw-semibold mt-1">{{ $booking->event_location }}</div>
                                        @endif
                                        @if ($booking->event_address)
                                            <div class="text-muted small">{{ $booking->event_address }}</div>
                                        @endif
                                    </td>

                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'bg-warning-subtle text-warning-emphasis',
                                                'diproses' => 'bg-info-subtle text-info-emphasis',
                                                'dikonfirmasi' => 'bg-success-subtle text-success-emphasis',
                                                'selesai' => 'bg-primary-subtle text-primary-emphasis',
                                                'dibatalkan' => 'bg-secondary-subtle text-secondary-emphasis',
                                            ] [$booking->status] ?? 'bg-secondary-subtle text-secondary-emphasis';
                                        @endphp

                                        <span class="badge {{ $statusClass}}">
                                            {{ ucFirst($booking->status) }}
                                        </span>
                                    </td>

                                    <td style="min-width: 200px;">
                                            {{ $booking->notes ?: 'Belum ada catatan' }}
                                    </td>

                                    <td class="text-nowrap">
                                        @if ($booking->final_price !== null)
                                            <strong class="text-success">
                                                Rp {{ number_format($booking->final_price, 0, ',', '.') }}
                                            </strong>
                                        @else
                                            <span class="text-muted">Belum ditentukan</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                        class="btn btn-sm btn-primary text-nowrap">
                                            <i class="bi bi-pencil-square me-1"></i>
                                            Edit Booking
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-3">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection