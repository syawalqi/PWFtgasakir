<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 w-full">
            <div>
                <h2 class="font-extrabold text-xl text-slate-800 leading-tight">
                    {{ __('Riwayat Aduan Saya') }}
                </h2>
                <p class="text-xs text-slate-400 mt-1 font-medium">Pantau perkembangan status semua laporan yang telah Anda kirimkan.</p>
            </div>
            
            <a href="{{ route('user.complaints.create') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition shadow-lg shadow-indigo-200 transform active:scale-95 shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Aduan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-indigo-100/10 overflow-hidden">
                <div class="p-10 text-center">
                    
                    @if($complaints->isEmpty())
                        <div class="flex flex-col items-center py-10 space-y-6">
                            <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center border border-indigo-100/50">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="space-y-2">
                                <h4 class="text-xl font-bold text-slate-900">Belum Ada Aduan</h4>
                                <p class="text-sm text-slate-500 max-w-sm mx-auto font-medium">Semua aspirasi, keluhan, atau laporan pengaduan masalah lingkungan yang Anda kirimkan akan tercatat rapi di halaman ini.</p>
                            </div>
                            <a href="{{ route('user.complaints.create') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold uppercase tracking-[0.15em] rounded-xl transition shadow-md">
                                Buat Laporan Sekarang
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50/50 border-b border-slate-100">
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Laporan</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($complaints as $complaint)
                                        <tr class="hover:bg-slate-50/40 transition">
                                            <td class="px-6 py-4 text-sm font-bold text-slate-800">{{ $complaint->title }}</td>
                                            <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $complaint->category->name }}</td>
                                            <td class="px-6 py-4 text-center">
                                                @if($complaint->status == 'pending')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">Menunggu</span>
                                                @elif($complaint->status == 'processing')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">Diproses</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Selesai</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-400 font-medium text-right">{{ $complaint->created_at->format('d M Y') }}</td>
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