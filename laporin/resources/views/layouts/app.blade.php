<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LaporIn') }}</title>

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

<!-- User Navbar -->
<nav class="user-navbar" x-data="{ mobileOpen: false }">
    <div class="navbar-inner">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="navbar-logo">
            <div class="navbar-logo-icon">
                <i class="fa-solid fa-megaphone" style="color:#fff;font-size:.75rem"></i>
            </div>
            LaporIn
        </a>

        <!-- Desktop Links -->
        <div class="navbar-links" style="display:none" id="desktop-nav">
            <a href="{{ route('dashboard') }}"
               class="navbar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house-chimney" style="margin-right:.3rem;font-size:.8rem"></i>
                Dashboard
            </a>
            <a href="{{ route('user.complaints.index') }}"
               class="navbar-link {{ request()->routeIs('user.complaints.*') ? 'active' : '' }}">
                <i class="fa-solid fa-inbox" style="margin-right:.3rem;font-size:.8rem"></i>
                Aduan Saya
            </a>
            <a href="{{ route('about') }}"
               class="navbar-link {{ request()->routeIs('about') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-info" style="margin-right:.3rem;font-size:.8rem"></i>
                Tentang
            </a>
        </div>

        <!-- User menu -->
        <div style="display:flex;align-items:center;gap:.75rem">
            <!-- Avatar + dropdown -->
            <div x-data="{ open: false }" style="position:relative">
                <button @click="open = !open"
                    style="display:flex;align-items:center;gap:.5rem;background:none;border:none;cursor:pointer;color:#e2e8f0;padding:.375rem .75rem;border-radius:8px;transition:.2s"
                    :style="open ? 'background:var(--surface-3)' : ''"
                >
                    <div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,#6366f1,#c084fc);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;flex-shrink:0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span style="font-size:.85rem;font-weight:500;max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-chevron-down" style="font-size:.65rem;color:#94a3b8;transition:transform .2s" :style="open ? 'transform:rotate(180deg)' : ''"></i>
                </button>

                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     @click.outside="open = false"
                     style="position:absolute;right:0;top:calc(100% + .5rem);width:200px;background:var(--surface-2);border:1px solid var(--border);border-radius:12px;padding:.5rem;box-shadow:0 12px 40px rgba(0,0,0,.5);z-index:100"
                >
                    <div style="padding:.5rem .75rem;margin-bottom:.25rem;border-bottom:1px solid var(--border)">
                        <p style="font-size:.8rem;font-weight:600;color:#e2e8f0">{{ Auth::user()->name }}</p>
                        <p style="font-size:.7rem;color:#64748b;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;display:flex;align-items:center;gap:.5rem;padding:.5rem .75rem;border-radius:8px;font-size:.85rem;color:#f87171;background:none;border:none;cursor:pointer;text-align:left;transition:.2s"
                            onmouseover="this.style.background='rgba(239,68,68,.1)'"
                            onmouseout="this.style.background='none'"
                        >
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Mobile menu toggle -->
            <button @click="mobileOpen = !mobileOpen"
                style="display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:var(--surface-3);border:none;color:#94a3b8;cursor:pointer"
                id="mobile-menu-btn"
            >
                <i class="fa-solid" :class="mobileOpen ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="border-top:1px solid var(--border);padding:1rem 1.5rem;display:flex;flex-direction:column;gap:.5rem"
    >
        <a href="{{ route('dashboard') }}" class="navbar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="display:block">
            <i class="fa-solid fa-house-chimney" style="margin-right:.5rem"></i>Dashboard
        </a>
        <a href="{{ route('user.complaints.index') }}" class="navbar-link {{ request()->routeIs('user.complaints.*') ? 'active' : '' }}" style="display:block">
            <i class="fa-solid fa-inbox" style="margin-right:.5rem"></i>Aduan Saya
        </a>
        <a href="{{ route('about') }}" class="navbar-link {{ request()->routeIs('about') ? 'active' : '' }}" style="display:block">
            <i class="fa-solid fa-circle-info" style="margin-right:.5rem"></i>Tentang
        </a>
    </div>
</nav>

<!-- Flash messages -->
@if (session('success'))
    <div id="toast-wrap" class="toast-container">
        <div class="toast toast-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('error'))
    <div id="toast-wrap-err" class="toast-container">
        <div class="toast toast-error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- Page Content -->
{{ $slot }}

<script>
// Show desktop nav on larger screens
function checkNav() {
    const nav = document.getElementById('desktop-nav');
    const btn = document.getElementById('mobile-menu-btn');
    if (!nav) return;
    if (window.innerWidth >= 640) {
        nav.style.display = 'flex';
        if(btn) btn.style.display = 'none';
    } else {
        nav.style.display = 'none';
        if(btn) btn.style.display = 'flex';
    }
}
checkNav();
window.addEventListener('resize', checkNav);

// Auto-dismiss toasts
document.querySelectorAll('.toast').forEach(t => {
    setTimeout(() => {
        t.style.transition = 'all .4s ease';
        t.style.opacity = '0';
        t.style.transform = 'translateX(100%)';
        setTimeout(() => t.parentElement?.remove(), 400);
    }, 4000);
});
</script>
</body>
</html>
