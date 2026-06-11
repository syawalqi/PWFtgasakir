<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaporIn') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased bg-slate-900">
    <!-- Kontainer Utama: Menggunakan Deep Indigo & Slate agar terlihat Official -->
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 flex flex-col justify-center items-center relative overflow-hidden px-4">
        
        <!-- Ornamen Ambient Glow Biru Indigo (Kesan Profesional & Serius) -->
        <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-indigo-500/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[100px] translate-x-1/4 translate-y-1/4 pointer-events-none"></div>

        <!-- Logo Identitas Aplikasi -->
        <div class="mb-8 relative z-10 text-center">
            <a href="/" class="text-3xl font-extrabold tracking-tighter text-white">
                LaporIn<span class="text-indigo-500">.</span>
            </a>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">Sistem Informasi Pengaduan</p>
        </div>

        <!-- Box Putih Form dengan Border yang Tegas -->
        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-indigo-950/50 rounded-2xl relative z-10 border border-slate-700/50">
            <div class="mb-6">
                {{ $slot }}
            </div>
        </div>
        
        <!-- Footer Autentikasi -->
        <div class="mt-10 text-center relative z-10">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                &copy; 2026 {{ config('app.name') }} &bull; Layanan Masyarakat Resmi
            </p>
        </div>
    </div>
</body>
</html>