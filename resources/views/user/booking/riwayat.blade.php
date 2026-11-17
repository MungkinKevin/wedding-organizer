@extends('layouts.app-user')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Riwayat Booking</h3>
        <a href="{{ route('landing') }}#packages" class="btn text-white fw-semibold" style="background-color: #e83e8c;">
            + Buat Booking Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Paket Wedding</th>
                            <th>Tanggal Acara</th>
                            <th>Catatan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $index => $item)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $item->paket->name ?? 'Paket tidak ditemukan' }}</td>
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada riwayat booking, silakan buat booking terlebih dahulu.
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