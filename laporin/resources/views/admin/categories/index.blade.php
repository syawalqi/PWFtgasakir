<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Kelola Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah Kategori</a>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead><tr class="border-b bg-gray-50 text-left"><th class="p-3">No</th><th class="p-3">Nama</th><th class="p-3">Jumlah Aduan</th><th class="p-3">Aksi</th></tr></thead>
            <tbody>
                @forelse ($categories as $i => $cat)
                    <tr class="border-b hover:bg-gray-50"><td class="p-3">{{ $i+1 }}</td><td class="p-3">{{ $cat->name }}</td><td class="p-3">{{ $cat->complaints_count }}</td><td class="p-3 flex gap-2"><a href="{{ route('admin.categories.edit', $cat) }}" class="text-amber-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline">Hapus</button></form></td></tr>
                @empty
                    <tr><td colspan="4" class="p-6 text-center text-gray-500">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
