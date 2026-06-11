<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
        
        <div class="bg-white rounded-2xl border border-slate-100 p-8 shadow-sm flex items-center space-x-6">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl">📢</div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Halo, {{ Auth::user()->name }}!</h2>
                <p class="text-sm text-slate-500 mt-1">Selamat datang di portal pengaduan resmi warga. Mari pantau laporan Anda.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                <div class="text-3xl font-extrabold text-slate-900">{{ $total }}</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1.5">Total Aduan</div>
            </div>
            <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                <div class="text-3xl font-extrabold text-amber-600">{{ $pending }}</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1.5">Menunggu</div>
            </div>
            <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                <div class="text-3xl font-extrabold text-indigo-600">{{ $diproses }}</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1.5">Diproses</div>
            </div>
            <div class="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm">
                <div class="text-3xl font-extrabold text-emerald-600">{{ $selesai }}</div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mt-1.5">Telah Selesai</div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-slate-900 to-indigo-950 p-8 rounded-2xl text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-lg shadow-indigo-950/20">
            <div>
                <h3 class="text-lg font-bold">Punya Masalah di Lingkungan Anda?</h3>
                <p class="text-xs text-slate-400 mt-1">Laporkan fasilitas publik yang bermasalah agar segera dieksekusi oleh tim dinas lapangan.</p>
            </div>
            <a href="{{ route('user.complaints.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white text-slate-900 font-bold rounded-xl shadow-md hover:bg-slate-50 transition duration-150">
                + Buat Laporan Baru
            </a>
        </div>
    </div>
</x-app-layout>