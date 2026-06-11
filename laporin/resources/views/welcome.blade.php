<x-app-layout>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center z-20">
        
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700 tracking-wide uppercase shadow-sm border border-indigo-200/50 mb-6">
            Official Government Reporting System
        </span>

        <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-[1.15]">
            Sistem Pengaduan <br>
            <span class="bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-700 bg-clip-text text-transparent">
                Masyarakat Digital
            </span>
        </h1>

        <p class="max-w-2xl mx-auto text-base sm:text-lg text-slate-500 font-medium leading-relaxed mb-10">
            Sampaikan aspirasi dan kendala fasilitas publik secara transparan. Kami berkomitmen memberikan layanan respon cepat demi kemajuan lingkungan bersama.
        </p>

        @auth
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transform hover:-translate-y-0.5 transition-all duration-150">
                    Masuk Ke Dashboard Anda
                </a>
            </div>
        @endauth

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left max-w-5xl mx-auto">
            
            <div class="bg-white/70 backdrop-blur-md p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-200 relative group">
                <div class="absolute -top-5 left-6 w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-600/20">
                    01
                </div>
                <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3">Prosedur Mudah</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Laporkan kendala melalui formulir digital yang ringkas dan mudah dipahami oleh seluruh lapisan masyarakat.
                </p>
            </div>

            <div class="bg-white/70 backdrop-blur-md p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-200 relative group">
                <div class="absolute -top-5 left-6 w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-600/20">
                    02
                </div>
                <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3">Pantau Real-time</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Transparansi penuh dalam proses penanganan laporan. Pantau status aduan Anda secara berkala dari dashboard.
                </p>
            </div>

            <div class="bg-white/70 backdrop-blur-md p-8 rounded-2xl border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-200 relative group">
                <div class="absolute -top-5 left-6 w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-600/20">
                    03
                </div>
                <h3 class="text-lg font-bold text-slate-900 mt-2 mb-3">Respon Terpadu</h3>
                <p class="text-sm text-slate-500 leading-relaxed">
                    Setiap laporan dikelola langsung oleh petugas dinas terkait untuk menjamin solusi yang tepat dan cepat.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>