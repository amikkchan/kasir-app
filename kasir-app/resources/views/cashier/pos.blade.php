@extends('layouts.main')

@section('content')
<h2 class="text-2xl font-bold mb-4">Kasir / Point of Sale (POS)</h2>

<div class="bg-white p-6 rounded shadow">
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h3 class="font-bold text-lg mb-4">🛒 Pilih Produk</h3>

    <!-- ✅ Daftar Produk -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        @forelse ($products as $p)
            <div class="border p-4 rounded shadow hover:shadow-lg cursor-pointer transition bg-gray-100"
                 onclick="addItem({{ $p->id }}, @js($p->name), {{ $p->price }})">
                <h4 class="font-semibold">{{ $p->name }}</h4>
                <p class="text-gray-600 text-sm">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
            </div>
        @empty
            <p class="text-gray-500 col-span-4">Tidak ada produk tersedia.</p>
        @endforelse
    </div>

    <hr class="my-4">

    <!-- ✅ Keranjang -->
    <h3 class="font-bold text-lg mb-2">🧾 Keranjang Belanja</h3>
    <form id="posForm" method="POST" action="{{ route('orders.store') }}">
        @csrf
        <table class="w-full text-sm mb-4 border">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left py-2 px-2">Produk</th>
                    <th class="text-left px-2">Qty</th>
                    <th class="text-left px-2">Harga</th>
                    <th class="text-left px-2">Subtotal</th>
                    <th class="text-left px-2">Aksi</th>
                </tr>
            </thead>
            <tbody id="cartBody"></tbody>
        </table>

        <div class="flex justify-end mb-4">
            <div class="text-right">
                <h4 class="text-lg font-bold">Total: Rp <span id="totalAmount">0</span></h4>
            </div>
        </div>

        <div class="flex justify-end items-center gap-2">
            <input type="number" name="paid" id="paid" class="border rounded p-2 w-48"
                placeholder="Bayar (Rp)" required>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Bayar & Simpan</button>
        </div>
    </form>
</div>

<script>
let cart = [];

function addItem(id, name, price) {
    let existing = cart.find(i => i.id === id);
    if (existing) existing.qty++;
    else cart.push({ id, name, price, qty: 1 });
    renderCart();
}

function removeItem(id) {
    cart = cart.filter(i => i.id !== id);
    renderCart();
}

function changeQty(id, qty) {
    let item = cart.find(i => i.id === id);
    if (item) item.qty = parseInt(qty);
    renderCart();
}

function renderCart() {
    let tbody = document.getElementById('cartBody');
    tbody.innerHTML = '';
    let total = 0;

    cart.forEach(i => {
        let subtotal = i.qty * i.price;
        total += subtotal;
        tbody.innerHTML += `
            <tr class="border-b">
                <td class="py-2 px-2">${i.name}</td>
                <td class="px-2">
                    <input type="number" min="1" value="${i.qty}"
                           class="w-16 border rounded p-1 text-center"
                           onchange="changeQty(${i.id}, this.value)">
                </td>
                <td class="px-2">Rp ${i.price.toLocaleString()}</td>
                <td class="px-2">Rp ${subtotal.toLocaleString()}</td>
                <td class="px-2">
                    <button type="button" class="text-red-500 hover:underline"
                            onclick="removeItem(${i.id})">Hapus</button>
                </td>
            </tr>
        `;
    });

    document.getElementById('totalAmount').innerText = total.toLocaleString();

    // Tambah hidden input untuk form
    let form = document.getElementById('posForm');
    form.querySelectorAll('input[name="items[]"]').forEach(e => e.remove());
    cart.forEach(i => {
        let hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'items[]';
        hidden.value = JSON.stringify({ product_id: i.id, quantity: i.qty });
        form.appendChild(hidden);
    });
}
</script>
@endsection
