@extends('layouts.main')
@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Produk</h2>

<form action="{{ route('products.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label>Nama Produk</label>
        <input type="text" name="name" class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Harga</label>
        <input type="number" name="price" class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Stok</label>
        <input type="number" name="stock" class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Kategori</label>
        <select name="category_id" class="border p-2 w-full rounded">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
