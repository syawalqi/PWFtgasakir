<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaporIn') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <div class="min-h-screen bg-gradient-to-tr from-slate-100 via-indigo-50/30 to-blue-100/40 flex flex-col relative overflow-hidden">
        
        <div class="absolute -top-24 -right-24 w-[700px] h-[700px] bg-indigo-200/20 rounded-full blur-[130px] pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-[700px] h-[700px] bg-blue-200/20 rounded-full blur-[130px] pointer-events-none"></div>

        <div class="relative z-30 bg-white/60 backdrop-blur-md border-b border-slate-200/60 shadow-sm">
            @include('layouts.navigation')
        </div>

        @if (isset($header))
            <header class="bg-white/40 backdrop-blur-sm border-b border-slate-200/40 relative z-20">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-1 h-6 bg-indigo-600 rounded-full"></div>
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endif

        <main class="flex-1 relative z-20">
            {{ $slot }}
        </main>

        <footer class="py-8 text-center relative z-20 border-t border-slate-200/50 bg-white/20 backdrop-blur-sm">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.25em]">
                &copy; {{ date('Y') }} {{ config('app.name') }} &bull; Sistem Layanan Pengaduan Masyarakat
            </p>
        </footer>
    </div>
</body>
</html>