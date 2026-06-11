<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Riwayat Aduan Saya</h2>
                        <p class="text-sm text-slate-500">Pantau perkembangan status semua laporan yang telah Anda kirimkan.</p>
                    </div>
                    <a href="{{ route('user.complaints.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-sm transition">
                        + Buat Aduan Baru
                    </a>
                </div>

                <div class="overflow-x-auto bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <table class="w-full text-sm text-left text-slate-500">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4">Judul Laporan</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($complaints as $complaint)
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $complaint->title }}</td>
                                    <td class="px-6 py-4">{{ $complaint->category?->name }}</td>
                                    <td class="px-6 py-4">
                                        <!-- FIX LOGIKA STATUS ENUM BAHASA INDONESIA TANPA SINTAKS BOCOR -->
                                        @if($complaint->status === 'pending')
                                            <span class="px-3 py-1 text-xs font-bold bg-amber-100 text-amber-800 rounded-full uppercase">Menunggu</span>
                                        @elseif($complaint->status === 'proses')
                                            <span class="px-3 py-1 text-xs font-bold bg-indigo-100 text-indigo-800 rounded-full uppercase">Diproses</span>
                                        @elseif($complaint->status === 'review')
                                            <span class="px-3 py-1 text-xs font-bold bg-blue-100 text-blue-800 rounded-full uppercase">Ditinjau Admin</span>
                                        @elseif($complaint->status === 'selesai')
                                            <span class="px-3 py-1 text-xs font-bold bg-emerald-100 text-emerald-800 rounded-full uppercase">Selesai</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold bg-slate-100 text-slate-800 rounded-full uppercase">{{ $complaint->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-slate-400">{{ $complaint->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('user.complaints.show', $complaint->id) }}" class="px-3 py-1 bg-slate-100 hover:bg-indigo-50 hover:text-indigo-600 rounded-md text-xs font-bold transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">Anda belum pernah membuat aduan laporan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>