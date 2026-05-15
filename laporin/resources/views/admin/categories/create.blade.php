<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Tambah Kategori</h1>
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-4"><label class="block text-sm font-medium text-gray-700">Nama Kategori</label><input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>@error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror</div>
            <div class="flex gap-2"><button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button><a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</a></div>
        </form>
    </div>
</x-admin-layout>
