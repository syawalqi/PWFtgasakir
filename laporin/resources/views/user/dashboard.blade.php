<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white/80 backdrop-blur-md rounded-[2rem] p-8 border border-slate-200/60 shadow-xl shadow-indigo-100/20 flex flex-col md:flex-row items-center md:space-x-8 relative overflow-hidden">
                
                <div class="w-20 h-20 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-2xl flex items-center justify-center shrink-0 shadow-lg shadow-indigo-200 relative z-10 mb-6 md:mb-0">
                    <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>

                <div class="relative z-10 text-center md:text-left">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Halo, {{ Auth::user()->name }}!</h3>
                    <p class="text-sm text-slate-500 mt-2 font-medium leading-relaxed max-w-xl">
                        Selamat datang di portal pengaduan resmi. Mari pantau dan kelola laporan aduan lingkungan Anda demi terciptanya pelayanan publik yang lebih baik.
                    </p>
                </div>
                
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900">{{ $totalAduan ?? 0 }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Aduan</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4 border border-amber-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900">{{ $pendingAduan ?? 0 }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Menunggu</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-4 border border-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900">{{ $prosessAduan ?? 0 }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Diproses</div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4 border border-emerald-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="text-3xl font-extrabold text-slate-900">{{ $selesaiAduan ?? 0 }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Telah Selesai</div>
                </div>
            </div>

            <div class="bg-slate-900 rounded-[2.5rem] p-10 relative overflow-hidden shadow-2xl shadow-indigo-900/20 group">
                <div class="absolute right-0 top-0 w-64 h-64 bg-indigo-600/20 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/4 pointer-events-none transition group-hover:bg-indigo-500/30"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <h4 class="text-2xl font-extrabold text-white tracking-tight">Punya Masalah di Lingkungan Anda?</h4>
                        <p class="text-indigo-200/70 text-sm mt-2 max-w-md leading-relaxed">Laporkan kendala fasilitas publik agar segera ditangani oleh petugas dinas terkait secara resmi dan terukur.</p>
                    </div>
                    <a href="{{ route('user.complaints.create') }}" class="inline-flex items-center justify-center px-10 py-4 bg-white hover:bg-indigo-50 text-indigo-900 font-extrabold text-xs uppercase tracking-widest rounded-2xl transition shadow-xl transform hover:-translate-y-1 active:scale-95 shrink-0">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Buat Aduan Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>