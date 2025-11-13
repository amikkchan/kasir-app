<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default redirect ke login / dashboard sesuai role
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin'
            ? redirect()->route('dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// ==========================
// 🔹 ADMIN ROUTES
// ==========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Produk & Kategori
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // POS & Transaksi
    Route::get('/pos', [OrderController::class, 'pos'])->name('pos');
    Route::resource('orders', OrderController::class)->except(['show', 'index']);
});

// ==========================
// 🔹 USER ROUTES
// ==========================
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/user/pos', [OrderController::class, 'pos'])->name('user.pos');
    Route::post('/user/orders', [OrderController::class, 'store'])->name('user.orders.store');
});

// ==========================
// 🔹 PROFILE ROUTES (semua role)
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// 🔹 AUTH
// ==========================
require __DIR__.'/auth.php';
