@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>

<!-- 🔍 Form Pencarian -->
<form action="{{ route('products.index') }}" method="GET" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ $search ?? '' }}" 
           placeholder="Cari produk..." 
           class="border border-gray-300 rounded p-2 w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">
    <button type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Cari
    </button>
    @if(request('search'))
        <a href="{{ route('products.index') }}" 
           class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
           Reset
        </a>
    @endif
</form>

<!-- Tombol tambah -->
<a href="{{ route('products.create') }}" 
   class="bg-blue-600 text-white px-4 py-2 rounded mb-3 inline-block hover:bg-blue-700 transition">
   + Tambah Produk
</a>

<!-- Pesan sukses -->
@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Menampilkan daftar produk per kategori -->
@if ($categories->count() > 0)
    @foreach ($categories as $category)
        @php
            $hasProducts = $category->products->count() > 0;
        @endphp

        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2 border-b pb-1 text-gray-700 flex items-center gap-2">
                <span class="text-blue-600">📦</span> {{ $category->name }}
            </h3>

            @if ($hasProducts)
            <table class="w-full border text-sm mb-2">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="p-2 text-left">Nama</th>
                        <th class="p-2 text-left">Harga</th>
                        <th class="p-2 text-left">Stok</th>
                        <th class="p-2 w-32 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->products as $p)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2">{{ $p->name }}</td>
                        <td class="p-2">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                        <td class="p-2">{{ $p->stock }}</td>
                        <td class="p-2">
                            <a href="{{ route('products.edit', $p->id) }}" 
                               class="text-blue-600 hover:underline">Edit</a> |
                            <form action="{{ route('products.destroy', $p->id) }}" 
                                  method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus produk ini?')" 
                                        class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-gray-500 italic mb-3">Tidak ada produk dalam kategori ini.</p>
            @endif
        </div>
    @endforeach
@else
    <p class="text-gray-500 italic">Belum ada kategori terdaftar.</p>
@endif
@endsection
