<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard untuk admin
     */
    public function index()
    {
        // Total produk
        $totalProducts = Product::count();

        // Total penjualan
        $totalSales = Order::sum('total');

        // Ambil 5 transaksi terbaru
        $recentOrders = Order::latest()->take(5)->get();

        // Tampilkan ke view dashboard.blade.php
        return view('dashboard', compact('totalProducts', 'totalSales', 'recentOrders'));
    }

    /**
     * Dashboard untuk user
     */
    public function userDashboard()
    {
        // Ambil order milik user yang login
        $totalProducts = Product::count();
        $totalSales = Order::where('user_id', Auth::id())->sum('total');
        $recentOrders = Order::where('user_id', Auth::id())
                            ->latest()
                            ->take(5)
                            ->get();

        // Gunakan layout dan view khusus user
        return view('users.dashboard', compact('totalProducts', 'totalSales', 'recentOrders'));
    }
}
