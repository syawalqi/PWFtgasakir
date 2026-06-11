<x-admin-layout>
    <div class="flex items-center space-x-3 mb-6">
        <a href="{{ route('admin.complaints.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Detail & Kelola Aduan</h1>
            <p class="text-xs text-slate-400 mt-0.5">Tinjau laporan warga, perbarui status penanganan, dan berikan tanggapan resmi.</p>
        </div>
    </div>

    <div class="space-y-6 max-w-4xl">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 overflow-hidden">
            <div class="p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4 pb-6 border-b border-slate-100">
                    <div class="space-y-1.5">
                        <span class="px-2.5 py-0.5 bg-slate-50 text-slate-600 border border-slate-100 rounded-md text-xs font-semibold">
                            {{ $complaint->category->name }}
                        </span>
                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $complaint->title }}</h2>
                        <p class="text-xs text-slate-400 font-medium flex flex-wrap items-center gap-2">
                            <span class="text-slate-700 font-semibold">{{ $complaint->user->name }}</span>
                            <span>&middot;</span>
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Masuk pada {{ $complaint->created_at->format('d M Y &middot; H:i') }} WIB
                            </span>
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
                            <img src="{{ asset('storage/'.$complaint->image) }}" alt="Bukti aduan" class="w-full max-h-96 object-cover transition-transform duration-300 group-hover:scale-[1.01]">
                        </div>
                    </div>
                @endif

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Tindakan Admin</h4>
                    <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" class="flex flex-col sm:flex-row gap-3 items-start sm:items-end p-4 bg-slate-50/80 border border-slate-100 rounded-xl max-w-xl">
                        @csrf @method('PATCH')
                        <div class="w-full sm:w-auto flex-1">
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Perbarui Status Aduan</label>
                            <select name="status" class="block w-full rounded-lg border-slate-200 px-3 py-2 text-sm text-slate-700 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5">
                                <option value="pending" {{ $complaint->status=='pending'?'selected':'' }}>⏳ Pending (Menunggu)</option>
                                <option value="diproses" {{ $complaint->status=='diproses'?'selected':'' }}>🔧 Diproses</option>
                                <option value="selesai" {{ $complaint->status=='selesai'?'selected':'' }}>✅ Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-lg transition duration-150 shadow-sm text-center">
                            Update Status
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50">
            <h3 class="font-bold text-lg text-slate-900 tracking-tight mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Riwayat Tanggapan Resmi ({{ $complaint->responses->count() }})
            </h3>
            
            <div class="space-y-4">
                @forelse ($complaints->responses ?? $complaint->responses as $r)
                    <div class="p-5 bg-slate-50/80 border border-slate-100 rounded-xl shadow-sm relative">
                        <div class="flex justify-between items-center text-xs mb-3">
                            <span class="font-bold text-slate-800 bg-white border border-slate-100 px-3 py-1 rounded-full flex items-center gap-1.5 shadow-sm">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full inline-block"></span>
                                {{ $r->user->name }}
                            </span>
                            <span class="text-slate-400 font-medium flex items-center">
                                <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $r->created_at->format('d M Y &middot; H:i') }} WIB
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $r->message }}</p>
                    </div>
                @empty
                    <div class="text-center py-6 border-2 border-dashed border-slate-100 rounded-2xl p-4">
                        <p class="text-sm text-slate-400 font-medium">Belum memberikan tanggapan resmi ke aduan ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-xl shadow-slate-100/50">
            <h3 class="text-lg font-bold text-slate-900 tracking-tight mb-4">Tambah Tanggapan Resmi</h3>
            <form method="POST" action="{{ route('admin.responses.store', $complaint) }}" class="space-y-4">
                @csrf
                <div>
                    <textarea name="message" rows="4" 
                        class="block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400" 
                        placeholder="Tuliskan respon resmi, instruksi tindakan, atau perkembangan laporan di sini..." required></textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-md shadow-slate-900/10">
                    Kirim Tanggapan
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>