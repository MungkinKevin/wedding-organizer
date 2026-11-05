@extends('layouts.app-admin')

@section('title', 'Dashboard Admin - WO Satria')

@section('content')
    
    <div class="welcome-banner text-white rounded-4 p-4 p-md-5 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row
                    justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-white text-theme-pink mb-2">
                    ADMIN PANEL
                </span>

                <h3 class="fw-bold mb-2">
                    Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!
                </h3>

                <p class="text-white-50 mb-0">
                    Kelola paket pernikahan, booking, testimoni,
                    dan galeri WO Satria dari satu tempat.
                </p>
            </div>

            <a href="#ringkasan"
               class="btn btn-light rounded-3 px-4 fw-semibold">
                <i class="bi bi-bar-chart-line me-2"></i>
                Lihat Ringkasan
            </a>
        </div>
    </div>

    
    <section id="ringkasan" class="mb-4">
        <div class="mb-3">
            <h5 class="fw-bold mb-1">Ringkasan Dashboard</h5>
            <p class="text-muted small mb-0">
                Gambaran singkat pengelolaan Wedding Organizer.
            </p>
        </div>

        <div class="row g-3">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="bi bi-gem"></i>
                        </div>
                        <span class="badge bg-danger-subtle text-danger">
                            Paket
                        </span>
                    </div>

                    <div class="text-muted small">Total Paket Wedding</div>
                    <h3 class="fw-bold mb-0">{{ $totalPaket }}</h3>
                    <small class="text-muted">Data paket tersedia</small>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <span class="badge bg-primary-subtle text-primary">
                            Booking
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
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-warning-emphasis">
                            Perlu dicek
                        </span>
                    </div>

                    <div class="text-muted small">Booking Menunggu</div>
                    <h3 class="fw-bold mb-0">{{ $totalPendingBooking }}</h3>
                    <small class="text-muted">Menunggu konfirmasi</small>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="stat-icon">
                            <i class="bi bi-chat-square-heart"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success">
                            Testimoni
                        </span>
                    </div>

                    <div class="text-muted small">Total Testimoni</div>
                    <h3 class="fw-bold mb-0">{{ $totalTestimoni }}</h3>
                    <small class="text-muted">Ulasan pelanggan</small>
                </div>
            </div>
        </div>
    </section>

    
    {{-- Booking Aktif --}}
    <section class="mt-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
            <div>
                <h5 class="fw-bold mb-1">Booking Pending, Diproses, dan dikonfirmasi</h5>
                <p class="text-muted small mb-0">
                    Tekan "lihat semua booking" untuk melihat detail booking. <br>
                    Pilih selesai jika acara selesai dan data harga final akan masuk ke pemasukan
                </p>
            </div>

            <a href="{{ route('admin.booking.index') }}"
               class="btn btn-outline-primary btn-sm rounded-3">
                Lihat Semua Booking
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($bookingsAktif->isEmpty())
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <i class="bi bi-calendar-check display-5 text-muted"></i>
                    <h6 class="fw-bold mt-3">Tidak Ada Booking Aktif</h6>
                    <p class="text-muted mb-0">
                        Belum ada booking yang perlu ditangani.
                    </p>
                </div>
            </div>
        @else
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Pelanggan</th>
                                    <th>Paket</th>
                                    <th>Tanggal Acara</th>
                                    <th>Status</th>
                                    <th>Catatan Admin</th>
                                    <th>Harga Final</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bookingsAktif as $booking)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-semibold">
                                                {{ $booking->user->name ?? 'User tidak ditemukan' }}
                                            </div>
                                            <small class="text-muted">
                                                Booking #{{ $booking->id }}
                                            </small>
                                        </td>

                                        <td>
                                            {{ $booking->paket->name ?? 'Paket tidak ditemukan' }}
                                        </td>

                                        <td class="text-nowrap">
                                            {{ \Carbon\Carbon::parse($booking->event_date)->format('d/m/Y') }}
                                        </td>

                                        <td>
                                            <form action="{{ route('admin.booking.updateStatus', $booking->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <select name="status"
                                                        class="form-select form-select-sm mb-2">
                                                    <option value="pending"
                                                        {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>

                                                    <option value="diproses"
                                                        {{ $booking->status == 'diproses' ? 'selected' : '' }}>
                                                        Diproses
                                                    </option>

                                                    <option value="dikonfirmasi"
                                                        {{ $booking->status == 'dikonfirmasi' ? 'selected' : '' }}>
                                                        Dikonfirmasi
                                                    </option>

                                                    <option value="selesai"
                                                        {{ $booking->status == 'selesai' ? 'selected' : '' }}>
                                                        Selesai
                                                    </option>

                                                    <option value="dibatalkan"
                                                        {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>
                                                        Dibatalkan
                                                    </option>
                                                </select>

                                                <button type="submit"
                                                        class="btn btn-sm btn-primary w-100">
                                                    Simpan Status
                                                </button>
                                            </form>
                                        </td>

                                        <td style="min-width: 180px;">
                                            <form action="{{ route('admin.booking.updateDetails', $booking->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <textarea name="notes"
                                                          class="form-control form-control-sm mb-2"
                                                          rows="2"
                                                          placeholder="Catatan admin">{{ $booking->notes }}</textarea>
                                        </td>

                                        <td style="min-width: 150px;">
                                                <input type="number"
                                                       name="final_price"
                                                       class="form-control form-control-sm"
                                                       min="0"
                                                       step="0.01"
                                                       value="{{ $booking->final_price }}"
                                                       placeholder="Harga final">
                                        </td>

                                        <td class="text-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-success text-nowrap">
                                                    <i class="bi bi-save me-1"></i>
                                                    Simpan Detail
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection