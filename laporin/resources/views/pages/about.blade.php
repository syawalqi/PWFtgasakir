<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tentang LaporIn') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Apa itu LaporIn?</h3>
                <p class="text-gray-700 mb-4">LaporIn adalah platform pengaduan masyarakat berbasis web yang memungkinkan warga untuk melaporkan berbagai masalah di lingkungan mereka secara mudah dan transparan.</p>

                <h4 class="text-lg font-semibold mb-2">Cara Kerja</h4>
                <ol class="list-decimal list-inside text-gray-700 mb-4 space-y-2">
                    <li>Daftar akun dan login ke sistem</li>
                    <li>Buat aduan dengan judul, kategori, dan deskripsi</li>
                    <li>Admin akan memproses dan menindaklanjuti aduan Anda</li>
                    <li>Pantau status aduan Anda secara real-time</li>
                </ol>

                <h4 class="text-lg font-semibold mb-2">Kontak</h4>
                <p class="text-gray-700">Email: support@lapor.in</p>
            </div>
        </div>
    </div>
</x-app-layout>
