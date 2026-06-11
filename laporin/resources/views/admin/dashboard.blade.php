<x-admin-layout>
    <div class="space-y-8">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard Admin</h2>
            <p class="text-sm text-slate-500 mt-1">Selamat datang kembali! Berikut adalah ringkasan aktivitas pengaudan hari ini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-white border border-purple-100/40 rounded-2xl shadow-xl shadow-purple-100/30 hover:border-pink-200 transition duration-200">
                <div class="w-10 h-10 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center mb-4 border border-pink-100/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">0</div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Total Aduan</div>
            </div>

            <div class="p-6 bg-white border border-purple-100/40 rounded-2xl shadow-xl shadow-purple-100/30 hover:border-purple-200 transition duration-200">
                <div class="w-10 h-10 bg-purple-50 text-purple-500 rounded-xl flex items-center justify-center mb-4 border border-purple-100/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">0</div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Pending</div>
            </div>

            <div class="p-6 bg-white border border-purple-100/40 rounded-2xl shadow-xl shadow-purple-100/30 hover:border-indigo-200 transition duration-200">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-500 rounded-xl flex items-center justify-center mb-4 border border-indigo-100/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">0</div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Diproses</div>
            </div>

            <div class="p-6 bg-white border border-purple-100/40 rounded-2xl shadow-xl shadow-purple-100/30 hover:border-emerald-200 transition duration-200">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center mb-4 border border-emerald-100/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-3xl font-extrabold text-slate-900">0</div>
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Selesai</div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-purple-100/50 shadow-xl shadow-purple-100/20 overflow-hidden">
            <div class="px-6 py-5 border-b border-purple-50 flex items-center justify-between">
                <h3 class="font-bold text-base text-slate-900">Aduan Terbaru</h3>
                <a href="{{ route('admin.complaints.index') }}" class="text-xs font-bold text-purple-600 hover:text-purple-700 transition-colors">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-purple-50/40 text-[10px] font-bold tracking-widest text-slate-400 uppercase border-b border-purple-50">
                            <th class="px-6 py-4">Pelapor</th>
                            <th class="px-6 py-4">Judul Aduan</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                        </tr>
                    </table>
                    <div class="p-12 text-center flex flex-col items-center justify-center text-slate-400">
                        <div class="w-12 h-12 bg-purple-50 text-purple-400 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-800">Belum Ada Pengaduan</p>
                        <p class="text-xs text-slate-400 mt-1">Laporan dari warga yang masuk ke sistem akan tampil di sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>