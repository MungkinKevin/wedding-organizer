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
                    <h3 class="fw-bold mb-0">--</h3>
                    <small class="text-muted">Ulasan pelanggan</small>
                </div>
            </div>
        </div>
    </section>
@endsection
