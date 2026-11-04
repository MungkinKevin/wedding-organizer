@extends('layouts.app-user')

@section('title', 'Beranda - WO Satria')

@section('content')
    <div class="card border-0 text-white mb-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #981172, #1e293b);">
        <div class="card-body p-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Selamat Datang, Pengantin Bahagia! 👋</h4>
                <p class="mb-0 text-white-50 small">Kelola rencana pernikahan impian Anda bersama WO SATRIA di sini.</p>
            </div>
            <a href="#" class="btn btn-light font-semibold text-danger border-0 px-4 rounded-3 shadow-sm" style="color: #e83e8c !important;">
                <i class="bi bi-search me-1"></i> Cari Paket
            </a>
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
                                <th>#</th>
                                <th>Nama Paket</th>
                                <th>Tanggal Acara</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $item->paket->name ?? 'Paket Tidak Ditemukan' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($item->paket->price ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if($item->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                        @elseif($item->status == 'approved' || $item->status == 'diterima')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($item->status == 'rejected' || $item->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                        @endif
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