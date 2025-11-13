@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-3 max-w-md">
    @csrf @method('PUT')

    <label>Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="border p-2 w-full">

    <label>Harga</label>
    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="border p-2 w-full">

    <label>Stok</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border p-2 w-full">

    <label>Kategori</label>
    <select name="category_id" class="border p-2 w-full">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
