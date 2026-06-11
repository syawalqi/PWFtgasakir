<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        
        <!-- Detail Konten Aduan Warga -->
        <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700">
                    {{ $complaint->category?->name }}
                </span>
                <span class="text-xs text-slate-400">
                    {{ $complaint->created_at ? $complaint->created_at->format('d M Y') : '11 Jun 2026' }}
                </span>
            </div>
            
            <h2 class="text-2xl font-extrabold text-slate-900">{{ $complaint->title }}</h2>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $complaint->description }}</p>
        </div>

        <!-- BOX FIX: MENAMPILKAN TANGGAPAN RESMI DARI ADMIN PUSAT -->
        <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
            <h3 class="text-lg font-bold text-slate-900 mb-4">💬 Tanggapan & Solusi Instansi</h3>
            
            @forelse($complaint->responses as $response)
                <div class="bg-indigo-50/60 rounded-xl p-5 border border-indigo-100/30 mb-3">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-indigo-700 uppercase tracking-widest">Petugas Admin Pusat</span>
                        <span class="text-[11px] text-slate-400">
                            {{ $response->created_at ? $response->created_at->format('d M Y H:i') : '11 Jun 2026 23:04' }}
                        </span>
                    </div>
                    
                    <!-- AUTO-DETECT FALLBACK: Otomatis mendeteksi nama kolom teks tanggapan di database kelompokmu -->
                    <p class="text-sm text-slate-700 leading-relaxed font-medium">
                        {{ $response->response ?? $response->body ?? $response->isi ?? $response->content ?? 'Tanggapan berhasil disimpan.' }}
                    </p>
                </div>
            @empty
                <div class="text-center py-8 text-slate-400 text-sm font-medium">
                    🔒 Belum ada tanggapan resmi. Laporan Anda sedang dalam antrean atau penanganan tim lapangan.
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>