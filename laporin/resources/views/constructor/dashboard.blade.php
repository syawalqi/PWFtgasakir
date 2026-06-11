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
                                <th class="px-6 py-3 text-center">Komentar</th>
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
                                                    ✓ Tandai Selesai
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

                                    {{-- KOMENTAR --}}
                                    <td class="px-6 py-4 text-center">
                                        <div x-data="{ open: false }">
                                            <button @click="open = !open"
                                                class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-lg transition">
                                                💬 {{ $tugas->responses->count() > 0 ? $tugas->responses->count() : 'Komentar' }}
                                            </button>

                                            <div x-show="open" @click.away="open = false"
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
                                                x-cloak>
                                                <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-lg mx-4 max-h-[80vh] overflow-y-auto"
                                                    @click.stop>
                                                    <div class="flex items-center justify-between mb-4">
                                                        <h4 class="font-bold text-slate-900">Komentar & Progress</h4>
                                                        <button @click="open = false" class="text-slate-400 hover:text-slate-600 text-xl leading-none">&times;</button>
                                                    </div>

                                                    <p class="text-sm font-semibold text-slate-700 mb-3">{{ $tugas->title }}</p>

                                                    {{-- Existing responses --}}
                                                    @if($tugas->responses->count() > 0)
                                                        <div class="space-y-3 mb-4 max-h-48 overflow-y-auto">
                                                            @foreach($tugas->responses as $response)
                                                                <div class="p-3 rounded-xl {{ $response->user_id === auth()->id() ? 'bg-blue-50 ml-4' : 'bg-slate-50 mr-4' }}">
                                                                    <div class="flex items-center justify-between mb-1">
                                                                        <span class="text-xs font-bold text-slate-500">{{ $response->user->name ?? 'User' }}</span>
                                                                        <span class="text-[10px] text-slate-400">{{ $response->created_at->diffForHumans() }}</span>
                                                                    </div>
                                                                    <p class="text-sm text-slate-700">{{ $response->message }}</p>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-xs text-slate-400 italic mb-4">Belum ada komentar.</p>
                                                    @endif

                                                    {{-- Comment form --}}
                                                    @if($tugas->status === 'proses')
                                                        <form method="POST" action="{{ route('constructor.complaints.comment', $tugas->id) }}" class="border-t border-slate-100 pt-4">
                                                            @csrf
                                                            <textarea name="message" rows="2" required
                                                                class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-slate-900 focus:ring focus:ring-slate-900/5"
                                                                placeholder="Tulis progres atau kendala di lapangan..."></textarea>
                                                            <button type="submit"
                                                                class="mt-2 w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition">
                                                                Kirim Komentar
                                                            </button>
                                                        </form>
                                                    @else
                                                        <p class="text-xs text-slate-400 italic text-center border-t border-slate-100 pt-4">
                                                            @if($tugas->status === 'review')
                                                                Menunggu konfirmasi admin
                                                            @else
                                                                Laporan telah selesai
                                                            @endif
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-slate-400 italic">
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
