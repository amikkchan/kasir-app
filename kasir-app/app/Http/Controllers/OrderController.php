<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Halaman kasir / POS
     */
    public function pos()
    {
        $products = \App\Models\Product::all(); // Produk untuk dipilih di frontend
        return view('cashier.pos', compact('products'));
    }

    /**
     * Simpan transaksi dari halaman POS
     */
    public function store(Request $r)
    {
        $r->validate([
            'items' => 'required|array|min:1',
            'paid' => 'required|numeric|min:0',
        ]);

        // Decode setiap item (karena dikirim sebagai JSON string dari form)
        $items = [];
        foreach ($r->items as $json) {
            $items[] = json_decode($json, true);
        }

        DB::beginTransaction();
        try {
            $total = 0;

            // Hitung total harga
            foreach ($items as $it) {
                $p = Product::findOrFail($it['product_id']);
                $subtotal = $p->price * intval($it['quantity']);
                $total += $subtotal;
            }

            // Buat invoice baru
            $invoice = 'INV-' . strtoupper(Str::random(8));
            $paid = $r->paid;
            $change = $paid - $total;

            // Simpan order utama
            $order = Order::create([
                'invoice' => $invoice,
                'user_id' => Auth::id(),
                'total' => $total,
                'paid' => $paid,
                'change' => $change >= 0 ? $change : 0,
                'status' => 'paid',
            ]);

            // Simpan item transaksi
            foreach ($items as $it) {
                $p = Product::findOrFail($it['product_id']);
                $qty = intval($it['quantity']);
                $subtotal = $p->price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'quantity' => $qty,
                    'price' => $p->price,
                    'subtotal' => $subtotal,
                ]);

                // Update stok produk
                $p->decrement('stock', $qty);
            }

            DB::commit();

            return redirect()
                ->route('dashboard')
                ->with('success', "Transaksi {$invoice} berhasil disimpan! Kembalian: Rp " . number_format($change, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Edit transaksi (ubah status)
     */
    public function edit(Order $order)
    {
        $order->load('items.product');
        return view('orders.edit', compact('order'));
    }

    /**
     * Update status transaksi
     */
    public function update(Request $r, Order $order)
    {
        $r->validate([
            'status' => 'required|string',
        ]);

        $order->update([
            'status' => $r->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diupdate.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
