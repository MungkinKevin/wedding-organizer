<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DASHBOARD USER - WO SATRIA')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --theme-pink: #e83e8c;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
        }

        .sidebar .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 4px;
        }

        .sidebar .nav-link:hover {
            color: var(--theme-pink);
            background-color: #fdf2f8;
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background-color: var(--theme-pink);
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar d-flex flex-column justify-content-between p-3">
            <div>
                <div class="pb-3 mb-3 border-bottom text-center">
                    <a href="#" class="d-block">
                        <img src="{{ asset('images/logo-wo.jpeg') }}" alt="Logo WO SATRIA" class="img-fluid" style="max-height: 100px; object-fit: contain;">
                    </a>
                </div>

                <ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill me-2"></i> Beranda
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/') }}#packages" class="nav-link">
            <i class="bi bi-gem me-2"></i> Lihat Paket Wedding
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('user.booking.index') }}" class="nav-link {{ request()->routeIs('user.booking.index') ? 'active' : '' }}">
            <i class="bi bi-journal-check me-2"></i> Riwayat Booking
        </a>
    </li>
</ul>
            </div>

            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                <!-- Bungkus bagian ini dengan tag <a> agar bisa diklik ke halaman profil -->
                <a href="{{ route('user.profile') }}" class="d-flex align-items-center gap-2 text-decoration-none" title="Lihat Profil">
                    <div class="rounded-circle bg-danger-subtle text-danger font-bold d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div style="line-height: 1.2;">
                        <span class="d-block fw-bold text-dark text-truncate" style="max-width: 110px; font-size: 13px;">{{ Auth::user()->name ?? 'User Client' }}</span>
                        <small class="text-muted" style="font-size: 11px;">{{ Auth::user()->email ?? 'user@gmail.com' }}</small>
                        
                    </div>
                </a>

                
                <a href="{{ route('logout') }}" class="text-secondary" title="Keluar" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bi bi-box-arrow-right"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-fill overflow-auto" style="height: 100vh;">
            <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center sticky-top">
    <h5 class="fw-bold mb-0 text-dark">Satria Wedding Organizer</h5>
    <div class="d-flex align-items-center gap-3">
        
        <!-- Dropdown Notifikasi -->
        <div class="dropdown">
            <button class="btn btn-light position-relative rounded-circle border-0 d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px;">
                <i class="bi bi-bell fs-5 text-secondary"></i>
                @if(isset($notifications) && $notifications->count() > 0)
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                @endif
            </button>
            
            <div class="dropdown-menu dropdown-menu-end p-3 shadow-lg border-0 rounded-4" style="width: 320px; max-height: 400px; overflow-y: auto;">
                <h6 class="fw-bold mb-3">Notifikasi</h6>
                <div class="list-group list-group-flush">
                    @forelse($notifications ?? [] as $notif)
                        <a href="{{ route('user.booking.index') }}" class="list-group-item list-group-item-action border-0 px-0 py-2 rounded-3 mb-1">
                            <div class="d-flex align-items-start gap-2">
                                <!-- Warna ikon  -->
                                <div class="rounded-circle p-2 d-flex align-items-center justify-content-center text-danger"style="width: 32px; height: 32px; min-width: 32px; background-color: #c84973;" >
                                    @if($notif->status == 'Selesai' || $notif->status == 'Dikonfirmasi')
                                        <i class="bi bi-check-lg"></i>
                                    @elseif($notif->status == 'Ditolak')
                                        <i class="bi bi-x-lg"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="mb-1 small text-dark">
                                        Status booking Paket <strong>{{ $notif->paket->name ?? 'Wedding' }}</strong> Anda saat ini: <strong>{{ ucfirst($notif->status) }}</strong>.
                                    </p>
                                    <span class="text-muted" style="font-size: 10px;">{{ $notif->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="small text-muted text-center mb-0 py-2">Belum ada notifikasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-house me-1"></i> Landing Page
        </a>
    </div>
</header>
     

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>