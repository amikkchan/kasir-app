@extends('layouts.main')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Kasir</h1>

    <a href="{{ route('pos') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Buat Transaksi Baru
    </a>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-2">Transaksi Terakhir</h2>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="text-left py-2">Invoice</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b">
                        <td class="py-2">{{ $order->invoice }}</td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center py-4">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
