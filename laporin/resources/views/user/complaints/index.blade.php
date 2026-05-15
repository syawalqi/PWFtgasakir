<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aduan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
            @endif

            <div class="mb-4">
                <a href="{{ route('user.complaints.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Buat Aduan Baru</a>
            </div>

            @if ($complaints->count() > 0)
                <div class="grid gap-4">
                    @foreach ($complaints as $complaint)
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $complaint->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $complaint->category->name }} &middot; {{ $complaint->created_at->format('d M Y') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $complaint->status_badge }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('user.complaints.show', $complaint) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                                @if ($complaint->isPending())
                                    <a href="{{ route('user.complaints.edit', $complaint) }}" class="text-amber-600 hover:underline text-sm">Edit</a>
                                    <form method="POST" action="{{ route('user.complaints.destroy', $complaint) }}" class="inline" onsubmit="return confirm('Hapus aduan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">{{ $complaints->links() }}</div>
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <p class="text-gray-500">Belum ada aduan.</p>
                    <a href="{{ route('user.complaints.create') }}" class="text-blue-600 hover:underline">Buat aduan sekarang</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
