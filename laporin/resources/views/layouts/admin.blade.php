<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LaporIn') }} – Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="admin-root" x-data="{ sidebar: window.innerWidth >= 1024, mobileOverlay: false }">

    <!-- Sidebar Overlay (mobile) -->
    <div
        @click="sidebar = false; mobileOverlay = false"
        class="sidebar-overlay"
        :class="{ 'visible': mobileOverlay && window.innerWidth < 1024 }"
    ></div>

    <!-- Sidebar -->
    <aside class="sidebar" :class="{ 'open': sidebar }">
        <!-- Logo -->
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i class="fa-solid fa-megaphone" style="color:#fff;font-size:.9rem"></i>
            </div>
            <span class="sidebar-logo-text">LaporIn</span>
            <span style="margin-left:auto;font-size:.65rem;padding:.15rem .45rem;border-radius:999px;background:rgba(99,102,241,.2);color:#818cf8;font-weight:700">ADMIN</span>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <p class="sidebar-section-label">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-chart-line"></i></span>
                Dashboard
            </a>

            <a href="{{ route('admin.complaints.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-inbox"></i></span>
                Semua Aduan
                @php $pendingCount = \App\Models\Complaint::where('status','pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span style="margin-left:auto;font-size:.7rem;padding:.15rem .5rem;border-radius:999px;background:rgba(245,158,11,.2);color:#fbbf24;font-weight:700">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-tags"></i></span>
                Kategori
            </a>

            <p class="sidebar-section-label">Lainnya</p>

            <a href="{{ route('about') }}"
               class="sidebar-link {{ request()->routeIs('about') ? 'active' : '' }}">
                <span class="icon"><i class="fa-solid fa-circle-info"></i></span>
                Tentang
            </a>
        </nav>

        <!-- Footer -->
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div style="flex:1;min-width:0">
                    <p style="font-size:.8rem;font-weight:600;color:#e2e8f0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ Auth::user()->name }}</p>
                    <p style="font-size:.7rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:.5rem">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-wrapper">
        <!-- Topbar -->
        <header class="admin-topbar">
            <button
                @click="sidebar = !sidebar; mobileOverlay = !sidebar && window.innerWidth < 1024"
                style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:1.1rem;padding:.375rem"
                title="Toggle sidebar"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <div style="display:flex;align-items:center;gap:.75rem">
                <div style="display:flex;align-items:center;gap:.5rem;color:#94a3b8;font-size:.8rem">
                    <i class="fa-solid fa-user-shield" style="color:#818cf8"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Flash -->
        @if (session('success'))
            <div id="toast-success" class="toast-container">
                <div class="toast toast-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session('error'))
            <div id="toast-error" class="toast-container">
                <div class="toast toast-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Content -->
        <main class="admin-content">
            {{ $slot }}
        </main>
    </div>

</div>

<script>
// Auto-dismiss toast after 4s
document.querySelectorAll('.toast').forEach(t => {
    setTimeout(() => {
        t.style.transition = 'all .4s ease';
        t.style.opacity = '0';
        t.style.transform = 'translateX(100%)';
        setTimeout(() => t.parentElement?.remove(), 400);
    }, 4000);
});

// Counter animation
function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.dataset.counter);
        const duration = 1200;
        const step = target / (duration / 16);
        let current = 0;
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = Math.floor(current);
            if (current >= target) clearInterval(timer);
        }, 16);
    });
}
document.addEventListener('DOMContentLoaded', animateCounters);
</script>
</body>
</html>
