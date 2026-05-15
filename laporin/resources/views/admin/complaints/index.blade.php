<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Semua Aduan</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div><label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>Diproses</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                </select></div>
            <div><label class="block text-sm font-medium text-gray-700">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Filter</button>
            <a href="{{ route('admin.complaints.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead><tr class="border-b bg-gray-50 text-left"><th class="p-3">No</th><th class="p-3">Pelapor</th><th class="p-3">Judul</th><th class="p-3">Kategori</th><th class="p-3">Status</th><th class="p-3">Tanggal</th><th class="p-3">Aksi</th></tr></thead>
            <tbody>
                @forelse ($complaints as $i => $c)
                    <tr class="border-b hover:bg-gray-50"><td class="p-3">{{ $complaints->firstItem() + $i }}</td><td class="p-3">{{ $c->user->name }}</td><td class="p-3">{{ $c->title }}</td><td class="p-3">{{ $c->category->name }}</td><td class="p-3"><span class="px-2 py-1 rounded-full text-xs {{ $c->status_badge }}">{{ ucfirst($c->status) }}</span></td><td class="p-3">{{ $c->created_at->format('d M Y') }}</td><td class="p-3"><a href="{{ route('admin.complaints.show', $c) }}" class="text-blue-600 hover:underline">Detail</a></td></tr>
                @empty
                    <tr><td colspan="7" class="p-6 text-center text-gray-500">Belum ada aduan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $complaints->links() }}</div>
</x-admin-layout>
