<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --theme-pink: #e83e8c;
            --theme-purple: #981172;
            --theme-dark: #1e293b;
            --theme-bg: #f8f9fa;
            --theme-light-pink: #fdf2f8;
        }

        body {
            background: var(--theme-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--theme-dark);
        }

        .admin-sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
            flex-shrink: 0;
        }

        .admin-sidebar .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .admin-sidebar .nav-link:hover {
            color: var(--theme-pink);
            background: var(--theme-light-pink);
        }

        .admin-sidebar .nav-link.active {
            color: #fff;
            background:var(--theme-pink);

        }

        .admin-main {
            min-width: 0;
            flex: 1;
        }

        .admin-header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        .welcome-banner {
            background: linear-gradient(
                135deg,
                var(--theme-purple),
                var(--theme-dark)
            );
        }

        .stad-card {
            background: #fff;
            border: 1px solid #f0e5ed;
            border-radius: 16px;
            transition: transform.2s ease, box-shadow.2s ease;
        }

        .stad-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8pc 24px rgba(30, 41, 59, .08);
        }

        .stad-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--theme-light-pink);
            color: var(--theme-pink);
            font-size: 22px;
        }

        .text-theme-pink {
            color: var(--theme-pink);
        }

        .btn-theme {
            background: var(--theme-pink);
            color: #fff;
            border: none;
        }

        .btn-theme:hover {
            backgrpund: #cc2875;
            color: #fff;
        }

        @media (max-width: 767.98px) {
            .admin-sidebar {
                width: 76px;
                padding: 12px !important;
            }

            .admin-sidebar .brand-text,
            .admin-sidebar .nav-label,
            .admin-sidebar .sidebar-user-info {
                display: none;
            }

            .admin-sidebar .nav-link {
                text-align: center;
                padding: 12px 6px;
            }

            .admin-sidebar .nav-link i {
                margin: 0 !important;
                font-size: 20px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="d-flex">
        <aside class="admin-sidebar d-flex flex-column justify-content-between p-3">
            <div>
                <div class="text-center pb-3 mb-3 border-bottom">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                        <img src="{{ asset('images/logo-wo.jpeg') }}"
                            alt="LOGO WO"
                            class="img-fluid mb-2"
                            style="max-height: 75px; object-fit: contain;">
                            
                        <div class="brand-text fw-bold text-dark">
                            WO SATRIA
                        </div>
                        <small class="brand-text text-muted"> ADMIN PANEL </small>
                    </a>
                </div>

                <nav class="nav nav-pills flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill me-2"></i>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.paket.index') }}" class="nav-link {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}">
                        <i class="bi bi-gem me-2"></i>
                        <span class="nav-label">Kelola Paket Wedding</span>
                    </a>
                    <a href="{{ route('admin.booking.index') }}" class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check me-2"></i>
                        <span class="nav-label">Booking</span>
                    </a>

                    <a href="{{ route('admin.testimoni.index')}}" class="nav-link {{ request()->routeIs('admin.testimoni.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-square-heart me-2"></i>
                        <span class="nav-label">Testimoni</span>
                    </a>

                    <a href="{{ route('admin.galeri.index')}}" class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                        <i class="bi bi-images me-2"></i>
                        <span class="nav-label">Galeri</span>
                    </a>
                </nav>
            </div>
            <div class="pt-3 mt-3 border-top">
                <div class=" d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger-subtle text0danger fw-bold"
                        style="width: 38px; height: 38px; flex-shrink: 0;">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="sidebar-user-info flex-grow-1 overflow-hidden">
                        <div class="fw-bold small text-truncate">
                            {{ Auth::user()->name ?? 'Administrator' }}
                        </div>
                        <small>Administrator</small>
                    </div>
                </div>

                <form action="{{ route('logout') }} " method="post" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="btn btn-outline-secondary btn-sm w-100">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        <span class="nav-label">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <div class="admin-main">
            <header class="admin-header sticky-top px-3 px-md-4 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0"> SATRIA WEDDING ORGANIZER</h5>
                    <small class="text-muted">Admin Panel</small>
                </div>

                <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="bi bi-house me-1"></i>
                    <span class="d-none d-sm-inline">Landing Page</span>
                </a>
            </header>

            <main class="p-3 p-md-4">
                @yield('content')
            </main>

            <footer class="text-center text-muted small py-3 px-3">
                &copy; {{ date('Y') }} Satria Wedding Organizer.
                All rights reserved.
            </footer>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>