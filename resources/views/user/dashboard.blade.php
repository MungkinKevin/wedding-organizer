@extends('layouts.app-user')

@section('title', 'Beranda - WO Satria')

@section('content')
    <div class="card border-0 text-white mb-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #981172, #1e293b);">
        <div class="card-body p-4">
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, Pengantin Bahagia! 👋</h4>
                <p class="mb-0 text-white-50 small">Kelola rencana pernikahan impian Anda bersama WO SATRIA di sini.</p>
            </div>
        </div>
    </div>

    <!-- Bagian Status Booking -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-dark">Status Booking Saya</h5>
        </div>
        <div class="card-body">
            @if($bookings->isEmpty())
                <div class="alert alert-info text-center mb-0">
                    Belum ada pemesanan paket pernikahan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Paket Wedding</th>
                                <th>Tanggal Acara</th>
                                <th>Catatan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $item)
                                <tr>
                                    <td class="fw-bold">{{ $item->paket->name ?? 'Paket Tidak Ditemukan' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}</td>
                                    <td>{{ $item->notes ?? '-' }}</td>
                                    <td>
                                        @if($item->final_price !== null)
                                            Rp {{ number_format($item->final_price, 0, ',', '.') }}
                                        @else
                                            Rp {{ number_format($item->paket->price ?? 0, 0, ',', '.') }}
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
                                            ][$item->status] ?? 'bg-secondary-subtle text-secondary-emphasis';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection