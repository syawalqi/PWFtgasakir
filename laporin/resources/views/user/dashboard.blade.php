<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mt-1">Kelola dan pantau aduan Anda di sini.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-500 text-white rounded-lg p-6 shadow">
                    <p class="text-3xl font-bold">{{ $total }}</p>
                    <p class="text-sm mt-1">Total Aduan</p>
                </div>
                <div class="bg-yellow-500 text-white rounded-lg p-6 shadow">
                    <p class="text-3xl font-bold">{{ $pending }}</p>
                    <p class="text-sm mt-1">Pending</p>
                </div>
                <div class="bg-amber-500 text-white rounded-lg p-6 shadow">
                    <p class="text-3xl font-bold">{{ $diproses }}</p>
                    <p class="text-sm mt-1">Diproses</p>
                </div>
                <div class="bg-green-500 text-white rounded-lg p-6 shadow">
                    <p class="text-3xl font-bold">{{ $selesai }}</p>
                    <p class="text-sm mt-1">Selesai</p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('user.complaints.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">+ Buat Aduan Baru</a>
            </div>
        </div>
    </div>
</x-app-layout>
