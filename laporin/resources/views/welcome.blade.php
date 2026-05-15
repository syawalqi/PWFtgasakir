<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LaporIn') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">LaporIn</h1>
                <div class="space-x-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Daftar</a>
                </div>
            </div>
        </header>
        <main class="flex-1 flex items-center justify-center">
            <div class="text-center max-w-2xl mx-auto px-4">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Selamat Datang di LaporIn</h2>
                <p class="text-lg text-gray-600 mb-8">Platform pengaduan masyarakat berbasis web. Laporkan masalah di lingkungan Anda dan pantau progresnya secara transparan.</p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">Buat Akun</a>
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-200 rounded-lg font-semibold hover:bg-gray-300">Masuk</a>
                </div>
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="bg-white p-6 rounded-lg shadow"><h3 class="font-semibold text-lg mb-2">Lapor</h3><p class="text-gray-600 text-sm">Sampaikan aduan Anda dengan mudah melalui formulir online.</p></div>
                    <div class="bg-white p-6 rounded-lg shadow"><h3 class="font-semibold text-lg mb-2">Pantau</h3><p class="text-gray-600 text-sm">Ikuti perkembangan status aduan Anda secara real-time.</p></div>
                    <div class="bg-white p-6 rounded-lg shadow"><h3 class="font-semibold text-lg mb-2">Selesai</h3><p class="text-gray-600 text-sm">Dapatkan tanggapan dan penyelesaian dari petugas terkait.</p></div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
