<x-admin-layout>
    <div class="max-w-4xl mx-auto py-8 space-y-6">
        <div class="bg-white rounded-2xl p-8 border border-purple-100 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900 mb-2">Detail Aduan: {{ $complaint->title }}</h2>
            <p class="text-sm text-slate-500">Status Saat Ini: <span class="font-bold uppercase text-indigo-600">{{ $complaint->status }}</span></p>
        </div>

        <div class="bg-white rounded-2xl p-8 border border-purple-100 shadow-sm space-y-4">
            
            @if($complaint->status === 'pending')
                <form method="POST" action="{{ route('admin.complaints.forward', $complaint->id) }}">
                    @csrf
                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition">
                        ➡ Teruskan Keluhan ke Tim Konstruktor Lapangan
                    </button>
                </form>
            @endif

            @if($complaint->status === 'proses')
                <div class="p-4 bg-amber-50 text-amber-800 text-sm font-semibold rounded-xl text-center shadow-sm border border-amber-100">
                    🚧 Laporan sedang dalam tahap pengerjaan fisik oleh tim konstruksi di lapangan...
                </div>
            @endif

            @if($complaint->status === 'review')
                <div class="border-t pt-6">
                    <h3 class="font-bold text-slate-900 mb-3">Form Verifikasi Akhir & Kirim Tanggapan ke User</h3>
                    <form method="POST" action="{{ route('admin.complaints.finalize', $complaint->id) }}" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Isi Tanggapan Resmi Instansi</label>
                            <textarea name="response" rows="4" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm" placeholder="Tuliskan konfirmasi resmi bahwa perbaikan dari tim konstruktor lapangan telah disetujui..." required></textarea>
                        </div>
                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-md transition">
                            ✓ Setujui Hasil Lapangan & Tandai Selesai Sempurna
                        </button>
                    </form>
                </div>
            @endif

            @if($complaint->status === 'selesai')
                <div class="p-4 bg-emerald-50 text-emerald-800 text-sm font-semibold rounded-xl text-center shadow-sm border border-emerald-100">
                    🎉 Keluhan publik ini telah dinyatakan selesai sepenuhnya dan ditanggapi resmi oleh pusat.
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>