<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'LaporIn') }}</title>
    
    <!-- Favicon Resmi -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="flex min-h-screen">
        
        <!-- Sidebar: Desain Profesional & Tegas -->
        <div class="flex flex-col w-64 bg-slate-900 shadow-xl shrink-0 relative z-30">
            <!-- Header Sidebar -->
            <div class="flex items-center px-6 h-20 border-b border-slate-800">
                <span class="font-extrabold tracking-tight text-xl text-white">
                    LaporIn<span class="text-indigo-500">.</span><span class="text-[10px] font-bold text-slate-400 ml-2 uppercase tracking-[0.2em]">Admin</span>
                </span>
            </div>

            <!-- Navigasi Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-sm rounded-xl transition duration-150 {{ Request::is('admin/dashboard') ? 'font-bold text-white bg-indigo-600 shadow-lg shadow-indigo-900/50' : 'font-medium text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>

                <a href="/admin/complaints" class="flex items-center px-4 py-3 text-sm rounded-xl transition duration-150 {{ Request::is('admin/complaints*') ? 'font-bold text-white bg-indigo-600 shadow-lg shadow-indigo-900/50' : 'font-medium text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Semua Aduan
                </a>

                <a href="/admin/categories" class="flex items-center px-4 py-3 text-sm rounded-xl transition duration-150 {{ Request::is('admin/categories*') ? 'font-bold text-white bg-indigo-600 shadow-lg shadow-indigo-900/50' : 'font-medium text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    Kategori
                </a>
            </nav>

            <!-- Bottom Sidebar -->
            <div class="p-4 border-t border-slate-800">
                <div class="bg-slate-800/50 rounded-2xl p-4 text-center">
                    <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Sistem Kelola Pusat</p>
                </div>
            </div>
        </div>

        <!-- Area Konten Utama -->
        <div class="flex-1 flex flex-col min-w-0 bg-slate-50">
            
            <!-- Topbar Atas -->
            <header class="flex items-center justify-between px-8 h-20 bg-white border-b border-slate-200 shrink-0 relative z-20">
                <div class="flex items-center text-slate-400 text-xs font-medium">
                    <span class="hover:text-indigo-600 cursor-pointer">Admin</span>
                    <span class="mx-2">/</span>
                    <span class="text-slate-900 font-bold capitalize">{{ Request::segment(2) }}</span>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] font-medium text-indigo-600 mt-1">Administrator Utama</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2.5 bg-slate-100 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-8 relative">
                <!-- Aksen Ambient Tipis (Indigo) -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-50 rounded-full blur-[120px] pointer-events-none"></div>
                
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>