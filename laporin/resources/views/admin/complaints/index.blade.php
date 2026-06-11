<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Semua Aduan Masuk</h1>
        <p class="text-xs text-slate-400 mt-1">Pantau, cari, dan kelola seluruh berkas laporan pengaduan dari warga secara real-time.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xl shadow-slate-100/50 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="w-full sm:w-auto min-w-[160px]">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Status Aduan</label>
                <select name="status" class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm text-slate-700 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>⏳ Pending</option>
                    <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>🔧 Diproses</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>✅ Selesai</option>
                </select>
            </div>

            <div class="w-full sm:w-auto flex-1 min-w-[240px]">
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Cari Kata Kunci</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketikkan judul laporan..." 
                    class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-sm text-slate-800 shadow-sm transition-all duration-150 focus:border-slate-900 focus:ring focus:ring-slate-900/5 placeholder:text-slate-400">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm rounded-xl transition duration-150 shadow-sm text-center">
                    Cari Data
                </button>
                <a href="{{ route('admin.complaints.index') }}" class="w-full sm:w-auto px-5 py-2.5 bg-slate-100 hover:bg-slate-200/70 text-slate-600 font-semibold text-sm rounded-xl transition duration-150 text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/70 text-slate-450 uppercase text-[11px] font-bold tracking-wider">
                        <th class="p-4 w-16 text-center text-slate-500">No</th>
                        <th class="p-4 text-slate-700">Pelapor</th>
                        <th class="p-4 text-slate-700">Judul Aduan</th>
                        <th class="p-4 text-slate-700">Kategori</th>
                        <th class="p-4 text-slate-700 text-center">Status</th>
                        <th class="p-4 text-slate-700 text-center">Tanggal</th>
                        <th class="p-4 text-slate-700 text-right pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($complaints as $i => $c)
                        <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $complaints->firstItem() + $i }}</td>
                            
                            <td class="p-4">
                                <div class="font-semibold text-slate-900">{{ $c->user->name }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">{{ $c->user->email }}</div>
                            </td>
                            
                            <td class="p-4 font-medium text-slate-700 max-w-xs truncate">{{ $c->title }}</td>
                            
                            <td class="p-4">
                                <span class="px-2.5 py-0.5 bg-slate-50 text-slate-600 border border-slate-100 rounded-md text-xs font-semibold">
                                    {{ $c->category->name }}
                                </span>
                            </td>
                            
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wide {{ $c->status_badge }}">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </td>
                            
                            <td class="p-4 text-center text-slate-500 text-xs font-medium">
                                {{ $c->created_at->format('d M Y') }}
                            </td>
                            
                            <td class="p-4 pr-6">
                                <div class="text-right">
                                    <a href="{{ route('admin.complaints.show', $c) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-xs rounded-lg transition duration-150">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center">
                                <div class="w-12 h-12 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3 border border-slate-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-800">Belum Ada Pengaduan</p>
                                <p class="text-xs text-slate-400 mt-0.5">Seluruh laporan aduan yang dikirimkan warga belum tersedia atau tidak ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $complaints->links() }}
    </div>
</x-admin-layout>