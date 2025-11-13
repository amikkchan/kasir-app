<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kasir App' }}</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- 🔹 Navbar -->
    <nav class="bg-white shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="font-bold text-xl">Kasir App</h1>

            <div class="flex gap-4 items-center flex-wrap">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'hover:text-blue-600' }}">
                   <i class="fa-solid fa-chart-line mr-1"></i> Dashboard
                </a>
                <a href="{{ route('products.index') }}"
                   class="{{ request()->routeIs('products.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'hover:text-blue-600' }}">
                   <i class="fa-solid fa-box mr-1"></i> Produk
                </a>
                <a href="{{ route('categories.index') }}"
                   class="{{ request()->routeIs('categories.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'hover:text-blue-600' }}">
                   <i class="fa-solid fa-tags mr-1"></i> Kategori
                </a>
                <a href="{{ route('pos') }}"
                   class="{{ request()->routeIs('pos') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'hover:text-blue-600' }}">
                   <i class="fa-solid fa-cash-register mr-1"></i> POS
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="{{ request()->routeIs('profile.edit') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'hover:text-blue-600' }}">
                   <i class="fa-solid fa-user mr-1"></i> Profil
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- 🔹 Main Content (container utama diperlebar) -->
    <main class="w-full px-6 lg:px-10 xl:px-16 2xl:px-24">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
