@extends('layouts.main')

@section('content')
<div class="py-8 w-full px-10 lg:px-20">
    <div class="bg-white p-6 rounded shadow">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6 text-center">
            {{ __('Dashboard Kasir') }}
        </h2>

        <!-- Statistik horizontal -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="flex items-center bg-blue-50 p-5 rounded-2xl shadow-md border border-blue-100">
        <div class="bg-blue-100 text-blue-700 p-3 rounded-full mr-4">
            <i class="fa-solid fa-box text-2xl"></i>
        </div>
        <div>
            <h2 class="text-gray-600 text-sm">Total Produk</h2>
            <p class="text-2xl font-bold text-blue-700">{{ $totalProducts }}</p>
        </div>
    </div>

    <div class="flex items-center bg-green-50 p-5 rounded-2xl shadow-md border border-green-100">
        <div class="bg-green-100 text-green-700 p-3 rounded-full mr-4">
            <i class="fa-solid fa-money-bill-wave text-2xl"></i>
        </div>
        <div>
            <h2 class="text-gray-600 text-sm">Total Penjualan</h2>
            <p class="text-2xl font-bold text-green-700">
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <div class="flex items-center bg-yellow-50 p-5 rounded-2xl shadow-md border border-yellow-100">
        <div class="bg-yellow-100 text-yellow-700 p-3 rounded-full mr-4">
            <i class="fa-solid fa-receipt text-2xl"></i>
        </div>
        <div>
            <h2 class="text-gray-600 text-sm">Transaksi Terbaru</h2>
            <p class="text-2xl font-bold text-yellow-700">{{ $recentOrders->count() }}</p>
        </div>
    </div>
</div>

        <!-- Transaksi -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">5 Transaksi Terbaru</h2>
            <a href="{{ route('pos') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition">
                + Tambah Transaksi
            </a>
        </div>

        <div class="bg-white p-4 rounded shadow overflow-x-auto overflow-visible">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="text-left py-2 px-3">Invoice</th>
                        <th class="text-left px-3">Total</th>
                        <th class="text-left px-3">Tanggal</th>
                        <th class="text-left px-3 w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-2 px-3">{{ $order->invoice }}</td>
                            <td class="px-3">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="px-3">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="px-3 py-2">
                                <div class="flex gap-2">
                                    <a href="{{ route('orders.edit', $order->id) }}"
                                       class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs transition">
                                        <i class="fa-solid fa-pen mr-1"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('orders.destroy', $order->id) }}"
                                          onsubmit="return confirm('Yakin hapus transaksi ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition">
                                            <i class="fa-solid fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Belum ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
