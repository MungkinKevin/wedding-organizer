
@extends('layouts.app-admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">

    {{-- Judul Dashboard --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard Admin</h3>
            <p class="text-muted mb-0">
                Selamat datang di halaman dashboard Wedding Organizer.
            </p>
        </div>
    </div>

    {{-- Statistik Dashboard --}}
    <div class="row g-3 mb-4">

        {{-- Total Paket --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Paket</p>
                            <h3 class="fw-bold mb-0">{{ $totalPaket }}</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                            <i class="bi bi-box-seam fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Booking --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Booking</p>
                            <h3 class="fw-bold mb-0">{{ $totalBooking }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 text-info rounded p-3">
                            <i class="bi bi-calendar-check fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Booking Pending --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Booking Pending</p>
                            <h3 class="fw-bold mb-0">{{ $totalPendingBooking }}</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded p-3">
                            <i class="bi bi-clock-history fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Testimoni --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Testimoni</p>
                            <h3 class="fw-bold mb-0">{{ $totalTestimoni }}</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded p-3">
                            <i class="bi bi-chat-square-text fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Statistik Pendapatan --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Booking Selesai</p>
                    <h3 class="fw-bold text-success mb-0">
                        {{ $totalBookingSelesai }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Pendapatan</p>
                    <h3 class="fw-bold text-primary mb-0">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel Booking Aktif --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Booking Aktif</h5>

                <a href="{{ route('admin.booking.index') }}"
                   class="btn btn-sm btn-outline-primary">
                    Lihat Semua Booking
                </a>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengantin / User</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Harga Final</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($bookingsAktif as $booking)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Nama Pengantin --}}
                                <td>
                                    <div class="fw-semibold">
                                        {{ $booking->bride_name && $booking->groom_name
                                            ? $booking->bride_name . ' & ' . $booking->groom_name
                                            : ($booking->user?->name ?? 'User tidak ditemukan') }}
                                    </div>

                                    <small class="text-muted">
                                        Booking #{{ $booking->id }}
                                    </small>
                                </td>

                                {{-- Nama Paket --}}
                                <td>
                                    {{ $booking->paket->nama_paket ?? '-' }}
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span class="badge
                                        @if ($booking->status == 'pending')
                                            bg-warning text-dark
                                        @elseif ($booking->status == 'diproses')
                                            bg-info text-dark
                                        @elseif ($booking->status == 'dikonfirmasi')
                                            bg-primary
                                        @elseif ($booking->status == 'selesai')
                                            bg-success
                                        @else
                                            bg-danger
                                        @endif">

                                        {{ ucfirst($booking->status) }}

                                    </span>
                                </td>

                                {{-- Catatan --}}
                                <td style="min-width: 180px;">
                                    {{ $booking->notes ?: 'Belum ada catatan' }}
                                </td>

                                {{-- Harga Final --}}
                                <td class="text-nowrap">
                                    @if ($booking->final_price !== null)
                                        <strong class="text-success">
                                            Rp {{ number_format($booking->final_price, 0, ',', '.') }}
                                        </strong>
                                    @else
                                        <span class="text-muted">
                                            Belum ditentukan
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                       class="btn btn-sm btn-primary text-nowrap">
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Edit Booking
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Belum ada booking aktif.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection
