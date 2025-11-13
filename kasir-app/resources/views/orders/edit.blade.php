<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kasir / Point of Sale (POS)') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-bold mb-4">Invoice: {{ $order->invoice }}</h3>

                <table class="w-full text-sm mb-4">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="text-left py-2 px-2">Produk</th>
                            <th class="text-left px-2">Qty</th>
                            <th class="text-left px-2">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr class="border-b">
                                <td class="py-2 px-2">{{ $item->product->name }}</td>
                                <td class="px-2">{{ $item->quantity }}</td>
                                <td class="px-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form method="POST" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Status Transaksi</label>
                        <select name="status" class="w-full border rounded p-2">
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
