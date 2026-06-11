<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
                    {{ __('Panel Instruksi Konstruksi') }}
                </h2>
                <p class="text-xs text-slate-400 mt-1 font-medium">Sistem Monitoring dan Eksekusi Perbaikan Fasilitas Publik di Lapangan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-2xl text-sm font-bold flex items-center">
                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-md rounded-[2rem] p-8 border border-slate-200/60 shadow-xl shadow-amber-100/10 flex flex-col md:flex-row items-center md:space-x-8 relative overflow-hidden">
                <div class="w-20 h-20 bg-gradient-to-tr from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-200 shrink-0 relative z-10">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div class="text-center md:text-left mt-4 md:mt-0 relative z-10">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Bekerja, Mitra Lapangan!</h3>
                    <p class="text-sm text-slate-500 font-medium mt-1 max-w-xl leading-relaxed">Berikut adalah daftar instruksi kerja perbaikan infrastruktur yang dialokasikan oleh tim pusat (Admin) kepada Anda hari ini.</p>
                </div>
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-amber-50 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-indigo-100/10 overflow-hidden">
                <div class="p-8 border-b border-slate-100 flex items-center justify-between bg-slate-50/40">
                    <h4 class="font-bold text-slate-800">Daftar Proyek Lapangan Aktif</h4>
                    <span class="px-4 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold rounded-xl">Total: {{ $complaints->count() }} Tugas</span>
                </div>

                <div class="p-8">
                    @if($complaints->isEmpty())
                        <div class="flex flex-col items-center py-12 space-y-4">
                            <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-sm text-slate-400 font-bold">Luar Biasa! Semua proyek infrastruktur lapangan selesai dikerjakan.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50/50 border-b border-slate-100">
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Aduan Fasilitas</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status Progress</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi Penanganan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($complaints as $complaint)
                                        <tr class="hover:bg-slate-50/40 transition">
                                            <td class="px-6 py-4 text-sm font-bold text-slate-800">{{ $complaint->title }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $complaint->category->name }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-orange-50 text-orange-700 border border-orange-100 animate-pulse">Sedang Diperbaiki</span>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <form action="{{ route('constructor.complaints.complete', $complaint->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl transition shadow-md active:scale-95">
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>