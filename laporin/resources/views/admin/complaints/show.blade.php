<x-admin-layout>
    <h1 class="text-2xl font-bold mb-6">Detail Aduan</h1>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex justify-between items-start mb-4"><div><h2 class="text-xl font-bold">{{ $complaint->title }}</h2><p class="text-sm text-gray-500">{{ $complaint->user->name }} &middot; {{ $complaint->category->name }} &middot; {{ $complaint->created_at->format('d M Y H:i') }}</p></div><span class="px-3 py-1 rounded-full text-sm font-medium {{ $complaint->status_badge }}">{{ ucfirst($complaint->status) }}</span></div>
        <p class="text-gray-700 mb-4">{{ $complaint->description }}</p>
        @if ($complaint->image)<img src="{{ asset('storage/'.$complaint->image) }}" class="max-w-md rounded-lg shadow mb-4">@endif

        <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" class="flex gap-2 items-end mt-4 p-4 bg-gray-50 rounded-lg">
            @csrf @method('PATCH')
            <div><label class="block text-sm font-medium text-gray-700">Update Status</label>
                <select name="status" class="mt-1 rounded-md border-gray-300 shadow-sm">
                    <option value="pending" {{ $complaint->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="diproses" {{ $complaint->status=='diproses'?'selected':'' }}>Diproses</option>
                    <option value="selesai" {{ $complaint->status=='selesai'?'selected':'' }}>Selesai</option>
                </select></div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Tanggapan ({{ $complaint->responses->count() }})</h3>
        @forelse ($complaint->responses as $r)
            <div class="mb-4 p-4 bg-gray-50 rounded-lg"><div class="flex justify-between text-sm text-gray-500 mb-2"><span class="font-medium">{{ $r->user->name }}</span><span>{{ $r->created_at->format('d M Y H:i') }}</span></div><p>{{ $r->message }}</p></div>
        @empty
            <p class="text-gray-500">Belum ada tanggapan.</p>
        @endforelse
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Tambah Tanggapan</h3>
        <form method="POST" action="{{ route('admin.responses.store', $complaint) }}">
            @csrf
            <textarea name="message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
            @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kirim Tanggapan</button>
        </form>
    </div>
</x-admin-layout>
