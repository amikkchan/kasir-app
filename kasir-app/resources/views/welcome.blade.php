<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir App</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col items-center justify-center min-h-screen">

    {{-- Logo --}}
    <div class="text-center mb-6">
        <img src="{{ asset('images/logo.png') }}" alt="Kasir App Logo" class="w-40 h-40 mx-auto mb-4">
        <h1 class="text-3xl font-bold text-blue-600">Kasir App</h1>
        <p class="text-gray-600 mt-2">Kelola transaksi dan stok barang dengan mudah</p>
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex gap-4 mt-6">
        <a href="{{ route('login') }}" 
           class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
           Masuk
        </a>
        <a href="{{ route('register') }}" 
           class="border border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 transition">
           Daftar
        </a>
    </div>

    {{-- Footer --}}
    <footer class="absolute bottom-4 text-gray-500 text-sm">
        &copy; {{ date('Y') }} Kasir App — All rights reserved.
    </footer>

</body>
</html>
 