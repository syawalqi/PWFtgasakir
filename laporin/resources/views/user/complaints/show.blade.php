<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Aduan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold">{{ $complaint->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $complaint->category->name }} &middot; {{ $complaint->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $complaint->status_badge }}">{{ ucfirst($complaint->status) }}</span>
                </div>
                <div class="prose max-w-none mt-4">
                    <p>{{ $complaint->description }}</p>
                </div>
                @if ($complaint->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $complaint->image) }}" alt="Gambar aduan" class="max-w-md rounded-lg shadow">
                    </div>
                @endif
            </div>

            @if ($complaint->isPending())
                <div class="flex gap-2 mb-6">
                    <a href="{{ route('user.complaints.edit', $complaint) }}" class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600">Edit</a>
                    <form method="POST" action="{{ route('user.complaints.destroy', $complaint) }}" onsubmit="return confirm('Hapus aduan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4 class="font-semibold text-lg mb-4">Riwayat Tanggapan</h4>
                @forelse ($complaint->responses as $response)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span class="font-medium">{{ $response->user->name }}</span>
                            <span>{{ $response->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <p>{{ $response->message }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada tanggapan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
