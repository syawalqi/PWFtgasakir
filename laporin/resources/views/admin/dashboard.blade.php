<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-blue-500 text-white rounded-lg p-6 shadow"><p class="text-3xl font-bold">{{ $total }}</p><p class="text-sm mt-1">Total Aduan</p></div>
        <div class="bg-yellow-500 text-white rounded-lg p-6 shadow"><p class="text-3xl font-bold">{{ $pending }}</p><p class="text-sm mt-1">Pending</p></div>
        <div class="bg-amber-500 text-white rounded-lg p-6 shadow"><p class="text-3xl font-bold">{{ $diproses }}</p><p class="text-sm mt-1">Diproses</p></div>
        <div class="bg-green-500 text-white rounded-lg p-6 shadow"><p class="text-3xl font-bold">{{ $selesai }}</p><p class="text-sm mt-1">Selesai</p></div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Aduan Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead><tr class="border-b text-left"><th class="pb-2">No</th><th class="pb-2">Pelapor</th><th class="pb-2">Judul</th><th class="pb-2">Kategori</th><th class="pb-2">Status</th><th class="pb-2">Tanggal</th></tr></thead>
                <tbody>
                    @foreach ($recentComplaints as $i => $c)
                        <tr class="border-b hover:bg-gray-50"><td class="py-2">{{ $i+1 }}</td><td class="py-2">{{ $c->user->name }}</td><td class="py-2">{{ $c->title }}</td><td class="py-2">{{ $c->category->name }}</td><td class="py-2"><span class="px-2 py-1 rounded-full text-xs {{ $c->status_badge }}">{{ ucfirst($c->status) }}</span></td><td class="py-2">{{ $c->created_at->format('d M Y') }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
