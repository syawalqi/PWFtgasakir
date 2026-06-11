<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('user.complaints.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight">{{ __('Detail Aduan') }}</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto space-y-6">
            
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3.5 rounded-xl text-sm font-medium shadow-sm flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 overflow-hidden">
                <div class="p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 pb-6 border-b border-slate-100">
                        <div class="space-y-1">
                            <span class="px-2.5 py-0.5 bg-slate-50 text-slate-600 border border-slate-100 rounded-md text-xs font-semibold">
                                {{ $complaint->category->name }}
                            </span>
                            <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-1">{{ $complaint->title }}</h3>
                            <p class="text-xs text-slate-400 font-medium flex items-center">
                                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Dilaporkan pada {{ $complaint->created_at->format('d M Y &middot; H:i') }} WIB
                            </p>
                        </div>
                        
                        <div class="shrink-0">
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold tracking-wide {{ $complaint->status_badge }}">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Deskripsi Pengaduan</h4>
                        <p class="text-slate-600 leading-relaxed text-base whitespace-pre-line">{{ $complaint->description }}</p>
                    </div>

                    @if ($complaint->image)
                        <div class="mt-6 pt-6 border-t border-slate-50">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Foto Bukti Lapangan</h4>
                            <div class="relative inline-block overflow-hidden rounded-xl border border-slate-100 shadow-sm max-w-xl group">
                                <img src="{{ asset('storage/' . $complaint->image) }}" alt="Gambar aduan" class="w-full max-h-96 object-cover transition-transform duration-300 group-hover:scale-[1.02]">
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($complaint->isPending())
                <div class="flex justify-start gap-3">
                    <a href="{{ route('user.complaints.edit', $complaint) }}" 
                       class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-sm shadow-amber-500/10">
                        Edit Laporan
                    </a>
                    <form method="POST" action="{{ route('user.complaints.destroy', $complaint) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini secara permanen?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 font-semibold text-sm rounded-xl transition duration-150">
                            Hapus Laporan
                        </button>
                    </form>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50">
                <h4 class="font-bold text-lg text-slate-900 tracking-tight mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Riwayat Tanggapan Resmi
                </h4>
                
                <div class="space-y-4">
                    @forelse ($complaint->responses as $response)
                        <div class="p-5 bg-slate-50/80 border border-slate-100 rounded-2xl shadow-sm relative">
                            <div class="flex justify-between items-center text-xs mb-3">
                                <span class="font-bold text-slate-800 bg-white border border-slate-100 px-3 py-1 rounded-full flex items-center gap-1.5 shadow-sm">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full inline-block"></span>
                                    {{ $response->user->name }}
                                </span>
                                <span class="text-slate-400 font-medium flex items-center">
                                    <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $response->created_at->format('d M Y &middot; H:i') }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $response->message }}</p>
                        </div>
                    @empty
                        <div class="text-center py-6 border-2 border-dashed border-slate-100 rounded-2xl p-4">
                            <p class="text-sm text-slate-400 font-medium">Belum ada tanggapan resmi dari pihak admin.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>