<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-amber-100">
                    <div class="text-sm font-medium text-slate-400 uppercase">Tugas Lapangan Aktif</div>
                    <div class="text-3xl font-bold text-amber-600">{{ $total }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-emerald-100">
                    <div class="text-sm font-medium text-slate-400 uppercase">Telah Dikerjakan / Review</div>
                    <div class="text-3xl font-bold text-emerald-600">{{ $selesai }}</div>
                </div>
            </div>

            {{-- TABEL TUGAS --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Daftar Tugas Perbaikan Lapangan</h3>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-emerald-50 text-emerald-800 text-sm font-semibold rounded-xl border border-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-500">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Judul Aduan</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Pelapor</th>
                                <th class="px-6 py-3">Status Pekerjaan</th>
                                <th class="px-6 py-3 text-center">Aksi Lapangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tugasLapangan as $index => $tugas)
                                <tr class="bg-white border-b hover:bg-slate-50">
                                    <td class="px-6 py-4 font-medium text-slate-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $tugas->title }}</td>
                                    <td class="px-6 py-4">{{ $tugas->category->name ?? 'Umum' }}</td>
                                    <td class="px-6 py-4">{{ $tugas->user->name ?? 'Anonim' }}</td>

                                    {{-- STATUS PEKERJAAN --}}
                                    <td class="px-6 py-4">
                                        @if($tugas->status === 'proses')
                                            <span class="px-3 py-1 text-xs font-bold bg-amber-100 text-amber-800 rounded-full uppercase">
                                                Sedang Dikerjakan
                                            </span>
                                        @elseif($tugas->status === 'review')
                                            <span class="px-3 py-1 text-xs font-bold bg-blue-100 text-blue-800 rounded-full uppercase">
                                                Menunggu Review Admin
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-bold bg-emerald-100 text-emerald-800 rounded-full uppercase">
                                                Selesai Total
                                            </span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($tugas->status === 'proses')
                                            <form method="POST" action="{{ route('constructor.complaints.update', $tugas->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    onclick="return confirm('Apakah pekerjaan perbaikan ini benar-benar sudah selesai?')"
                                                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg shadow transition">
                                                    ✓ Tandai Selesai & Kirim ke Admin
                                                </button>
                                            </form>
                                        @elseif($tugas->status === 'review')
                                            <span class="px-3 py-1 text-xs font-bold bg-blue-100 text-blue-800 rounded-full uppercase">
                                                Menunggu Konfirmasi Admin
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 italic">
                                                ✓ Laporan Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-400 italic">
                                        Belum ada tugas perbaikan lapangan yang dialokasikan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>