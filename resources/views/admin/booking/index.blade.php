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
                                <th>Pelanggan</th>
                                <th>Paket</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Catatan</th>
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
                                            {{ $booking ->user?->email ?? 'Pengguna tidak terdaftar' }}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $booking->user?->email ?? '-'}}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $booking->user?->phone ?? '-'}}
                                        </div>
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

                                    <td class="text-nowrap">
                                        {{ \Carbon\carbon::parse($booking->event_date)->translatedFormat('d M Y') }}
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

                                    <td class="min-width: 180px;">
                                        {{ $booking->notes ?? '-' }}
                                    </td>

                                    <td style="min-width: 220px">
                                        <form action=" {{ route('admin.booking.updateStatus', $booking->id )}}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status" id="form-select form-select-sm mb-2" required>
                                                @foreach ([
                                                    'pending' => 'Pending',
                                                    'diproses' => 'Diproses',
                                                    'dikonfirmasi' => 'Dikonfirmasi',
                                                    'selesai' => 'Selesai',
                                                    'dibatalkan' => 'Dibatalkan',
                                                ] as $value => $label)
                                                    <option value="{{ $value }}" @selected($booking->status === $value)>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                                <i class="bi bi-save-me-1"></i>
                                                Simpan status
                                            </button>
                                        </form>
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