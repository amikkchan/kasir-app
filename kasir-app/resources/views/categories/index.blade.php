@extends('layouts.main')

@section('content')
<h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
    📦 Kategori Produk
</h2>

@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Form tambah kategori -->
<form action="{{ route('categories.store') }}" method="POST" class="flex gap-2 mb-6 bg-white p-4 rounded shadow">
    @csrf
    <input type="text" name="name" placeholder="Masukkan nama kategori baru..." class="border p-2 flex-1 rounded" required>
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">+ Tambah Kategori</button>
</form>

<!-- Daftar kategori dan produknya -->
@foreach ($categories as $c)
<div class="bg-white p-5 rounded shadow mb-6">
    <div class="flex justify-between items-center border-b pb-2 mb-3">
        <h3 class="text-xl font-semibold text-gray-700">{{ $c->name }}</h3>
        <form action="{{ route('categories.destroy', $c->id) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button onclick="return confirm('Yakin hapus kategori ini?')" 
                    class="text-red-600 hover:underline text-sm">Hapus</button>
        </form>
    </div>

    <!-- Daftar produk dalam kategori -->
    @if ($c->products->count() > 0)
        <table class="w-full border text-sm mb-4">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-2 text-left">Nama Produk</th>
                    <th class="p-2 text-left">Harga</th>
                    <th class="p-2 text-left">Stok</th>
                    <th class="p-2 text-left w-24">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($c->products as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $p->name }}</td>
                    <td class="p-2">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $p->stock }}</td>
                    <td class="p-2">
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus produk ini?')" 
                                    class="text-red-600 hover:underline text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 italic mb-4">Belum ada produk dalam kategori ini.</p>
    @endif

    <!-- Form tambah produk baru ke kategori ini -->
    <form action="{{ route('products.store') }}" method="POST" class="grid grid-cols-4 gap-2 items-center border-t pt-3">
        @csrf
        <input type="hidden" name="category_id" value="{{ $c->id }}">
        <input type="text" name="name" placeholder="Nama produk" class="border p-2 rounded" required>
        <input type="number" name="price" placeholder="Harga" class="border p-2 rounded" required>
        <input type="number" name="stock" placeholder="Stok" class="border p-2 rounded" required>
        <button class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 transition">+ Tambah Produk</button>
    </form>
</div>
@endforeach
@endsection
