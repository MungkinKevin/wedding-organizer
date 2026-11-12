@extends('layouts.app-admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Judul halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Laporan Wedding Organizer</h3>
            <p class="text-muted mb-0">
                Ringkasan booking dan pendapatan Wedding Organizer.
            </p>
        </div>

        <button onclick="window.print()" class="btn btn-dark">
            <i class="bi bi-printer me-2"></i> Cetak Laporan
        </button>
    </div>

    {{-- Filter laporan --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4 filter-section">
        <div class="card-body">
            <form action="{{ route('admin.laporan.index') }}"
                  method="GET"
                  class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label for="bulan" class="form-label fw-semibold">
                        Bulan Acara
                    </label>

                    <select name="bulan" id="bulan" class="form-select">
                        <option value="">Semua Bulan</option>

                        @foreach ([
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                        ] as $nomor => $nama)
                            <option value="{{ $nomor }}"
                                {{ request('bulan') == $nomor ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tahun" class="form-label fw-semibold">
                        Tahun Acara
                    </label>

                    <select name="tahun" id="tahun" class="form-select">
                        <option value="">Semua Tahun</option>

                        @foreach ($daftarTahun as $tahun)
                            <option value="{{ $tahun }}"
                                {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>

                    <a href="{{ route('admin.laporan.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Ringkasan laporan --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="bi bi-calendar-check fs-3"></i>
                        </div>

                        <div>
                            <p class="text-muted mb-1">Total Booking</p>
                            <h3 class="fw-bold mb-0">
                                {{ number_format($totalBooking, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>

                        <div>
                            <p class="text-muted mb-1">Total Pendapatan</p>
                            <h3 class="fw-bold text-success mb-0">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>

                    <small class="text-muted">
                        Dihitung dari booking berstatus selesai.
                    </small>
                </div>
            </div>
        </div>

    </div>

    {{-- Tabel seluruh booking --}}
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Data Seluruh Booking</h5>
            <small class="text-muted">
                Menampilkan booking berdasarkan tanggal acara.
            </small>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Nama Pelanggan</th>
                            <th>Paket Wedding</th>
                            <th>Tanggal Acara</th>
                            <th>Harga Final</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>
                                    {{ $loop->iteration + $bookings->firstItem() - 1 }}
                                </td>

                                <td>
                                    {{ $booking->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $booking->paket->name ?? '-' }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($booking->event_date)->format('d-m-Y') }}
                                </td>

                                <td>
                                    @if ($booking->final_price !== null)
                                        Rp {{ number_format($booking->final_price, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'bg-warning text-dark',
                                            'diproses' => 'bg-info text-dark',
                                            'dikonfirmasi' => 'bg-primary',
                                            'selesai' => 'bg-success',
                                            'dibatalkan' => 'bg-danger',
                                        ][$booking->status] ?? 'bg-secondary';
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data booking untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $bookings->links() }}
            </div>

        </div>
    </div>

</div>

{{-- Pengaturan tampilan saat dicetak --}}
<style>
    @media print {
        .filter-section,
        button,
        .pagination,
        nav,
        aside {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .container-fluid {
            width: 100% !important;
        }
    }
</style>
@endsection