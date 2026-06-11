<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaporIn - Sistem Informasi Pengaduan Masyarakat</title>

    <!-- Favicon Resmi -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-900 text-white">

    <!-- Kontainer Utama dengan Background Foto "Official" -->
    <div class="min-h-screen relative flex flex-col overflow-hidden">
        
        <!-- Background Image Layer: Menggunakan foto infrastruktur/kantor sesuai masukan tim -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80" 
                 alt="Background Office" 
                 class="w-full h-full object-cover opacity-30">
            <!-- Overlay Biru Indigo Gelap agar Teks Terbaca & Terkesan Formal -->
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/90 via-indigo-950/80 to-slate-900"></div>
        </div>

        <!-- 1. Navigasi Atas -->
        <nav class="relative z-30 bg-white/5 backdrop-blur-md border-b border-white/10 h-20 flex items-center">
            <div class="max-w-7xl mx-auto w-full px-6 flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span class="font-extrabold tracking-tighter text-2xl text-white">
                        LaporIn<span class="text-indigo-500">.</span>
                    </span>
                </div>
                
                <div class="flex items-center space-x-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-white hover:text-indigo-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-300 hover:text-white transition">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition shadow-lg shadow-indigo-900/40">
                                    Daftar Akun
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- 2. Hero Section Profesional -->
        <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-20 relative z-20 max-w-5xl mx-auto">
            
            <!-- Badge Identitas Resmi -->
            <div class="inline-flex items-center px-4 py-1.5 bg-indigo-500/10 backdrop-blur-md text-indigo-400 text-[10px] font-bold uppercase tracking-[0.3em] rounded-full border border-indigo-500/20 mb-8">
                Official Government Reporting System
            </div>

            <div class="space-y-6">
                <h1 class="text-5xl sm:text-7xl font-extrabold text-white tracking-tight leading-tight">
                    Sistem Pengaduan <br> <span class="text-indigo-500">Masyarakat Digital</span>
                </h1>
                <p class="text-base sm:text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
                    Sampaikan aspirasi dan kendala fasilitas publik secara transparan. Kami berkomitmen memberikan layanan respon cepat demi kemajuan lingkungan bersama.
                </p>
            </div>

            <!-- Tombol Aksi Utama -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-12 w-full sm:w-auto">
                <a href="/user/complaints/create" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs uppercase tracking-widest rounded-2xl transition shadow-xl shadow-indigo-900/40 transform hover:-translate-y-1">
                    Mulai Melapor
                </a>
                
                <a href="/user/complaints" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-white/5 hover:bg-white/10 text-white font-extrabold text-xs uppercase tracking-widest rounded-2xl transition border border-white/10 backdrop-blur-sm transform hover:-translate-y-1">
                    Cek Status Aduan
                </a>
            </div>

            <!-- 3. Fitur Keunggulan (Grid Formal) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-24 w-full text-left">
                <div class="p-8 bg-slate-800/40 backdrop-blur-md border border-white/5 rounded-3xl">
                    <div class="w-12 h-12 bg-indigo-600/20 text-indigo-400 rounded-xl flex items-center justify-center mb-6 border border-indigo-600/30 font-bold text-lg">01</div>
                    <h4 class="font-bold text-lg text-white mb-2">Prosedur Mudah</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">Laporkan kendala melalui formulir digital yang ringkas dan mudah dipahami oleh seluruh lapisan masyarakat.</p>
                </div>

                <div class="p-8 bg-slate-800/40 backdrop-blur-md border border-white/5 rounded-3xl">
                    <div class="w-12 h-12 bg-indigo-600/20 text-indigo-400 rounded-xl flex items-center justify-center mb-6 border border-indigo-600/30 font-bold text-lg">02</div>
                    <h4 class="font-bold text-lg text-white mb-2">Pantau Real-time</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">Transparansi penuh dalam proses penanganan laporan. Pantau status aduan Anda secara berkala dari dashboard.</p>
                </div>

                <div class="p-8 bg-slate-800/40 backdrop-blur-md border border-white/5 rounded-3xl">
                    <div class="w-12 h-12 bg-indigo-600/20 text-indigo-400 rounded-xl flex items-center justify-center mb-6 border border-indigo-600/30 font-bold text-lg">03</div>
                    <h4 class="font-bold text-lg text-white mb-2">Respon Terpadu</h4>
                    <p class="text-sm text-slate-400 leading-relaxed">Setiap laporan dikelola langsung oleh petugas dinas terkait untuk menjamin solusi yang tepat dan cepat.</p>
                </div>
            </div>
        </main>

        <!-- 4. Footer Resmi -->
        <footer class="py-10 text-center relative z-30 border-t border-white/5 bg-slate-950/50 backdrop-blur-md">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.4em]">
                &copy; {{ date('Y') }} {{ config('app.name') }} &bull; Sistem Layanan Informasi Pemerintah
            </p>
        </footer>
    </div>
</body>
</html>