<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Halaman Tidak Ditemukan - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center"><h1 class="text-6xl font-bold text-yellow-500">404</h1>
        <p class="text-xl text-gray-700 mt-4">Halaman Tidak Ditemukan</p>
        <p class="text-gray-500 mt-2">Halaman yang Anda cari tidak tersedia.</p>
        <a href="{{ url('/') }}" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Kembali ke Beranda</a>
    </div>
</body>
</html>