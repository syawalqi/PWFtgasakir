<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
            {{ __('Ringkasan Laporan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50 mb-8 relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-pink-50 rounded-full blur-2xl opacity-60"></div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-slate-500 mt-1 font-medium">Kelola dan pantau aduan Anda di sini dengan mudah dan transparan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $total ?? 0 }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Total Aduan</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $pending ?? 0 }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Pending</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $diproses ?? 0 }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Diproses</p>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-md hover:shadow-xl transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-900">{{ $selesai ?? 0 }}</p>
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-wider mt-1">Selesai</p>
                </div>

            </div>

            <div class="bg-slate-900 rounded-3xl p-10 text-center relative overflow-hidden shadow-2xl shadow-slate-900/20">
                <div class="relative z-10">
                    <h4 class="text-white text-xl font-bold mb-2">Punya masalah di lingkungan Anda?</h4>
                    <p class="text-slate-400 text-sm mb-8 max-w-md mx-auto">Klik tombol di bawah untuk membuat laporan baru secara cepat dan terpantau oleh admin.</p>
                    <a href="{{ route('user.complaints.create') }}" class="inline-flex items-center px-8 py-4 bg-white text-slate-900 hover:bg-pink-50 hover:text-pink-600 font-extrabold text-sm rounded-2xl transition duration-300 shadow-lg tracking-wide uppercase">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        + Buat Aduan Baru
                    </a>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-pink-500/10 rounded-full blur-3xl"></div>
            </div>

        </div>
    </div>
</x-app-layout>