<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | NusaJelajah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

<div class="admin-wrapper">
    {{-- Sidebar --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <i class="fas fa-compass"></i>
                <span>NusaJelajah</span>
            </a>
            <button class="sidebar-toggle-close" id="sidebarClose">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div class="sidebar-username">{{ auth()->user()->name }}</div>
                <div class="sidebar-role">Administrator</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.pakets.index') }}"
               class="nav-item {{ request()->routeIs('admin.pakets.*') ? 'active' : '' }}">
                <i class="fas fa-map-location-dot"></i>
                <span>Kelola Paket</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}"
               class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Kelola Booking</span>
                @php $pending = \App\Models\Booking::byStatus('Pending')->count(); @endphp
                @if($pending > 0)
                    <span class="nav-badge">{{ $pending }}</span>
                @endif
            </a>

            <a href="{{ route('admin.pembayaran.index') }}"
               class="nav-item {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Pembayaran Cash</span>
            </a>

            <div class="nav-section-label" style="margin-top:1rem;">Lainnya</div>
            <a href="{{ route('home') }}" class="nav-item" target="_blank">
                <i class="fas fa-globe"></i>
                <span>Lihat Website</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item nav-item-btn">
                    <i class="fas fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="admin-main">
        <header class="admin-header">
            <button class="header-menu-btn" id="sidebarOpen">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-breadcrumb">
                <span>Admin</span>
                <i class="fas fa-chevron-right"></i>
                <span>@yield('title', 'Dashboard')</span>
            </div>
            <div class="header-right">
                <span class="header-greeting">Halo, {{ auth()->user()->name }}</span>
            </div>
        </header>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error alert-dismissible">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script>
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    document.getElementById('sidebarOpen')?.addEventListener('click', () => {
        sidebar.classList.add('open');
        overlay.classList.add('active');
    });
    document.getElementById('sidebarClose')?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
    });
    setTimeout(() => document.querySelector('.alert-dismissible')?.remove(), 4000);
</script>
@stack('scripts')
</body>
</html>