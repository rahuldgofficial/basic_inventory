<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Suppliers
    Route::resource('suppliers', SupplierController::class)->except(['show']);

    // Products
    Route::resource('products', ProductController::class);

    // Stock Management
    Route::get('/products/{product}/stock', [StockController::class, 'create'])->name('stock.create');
    Route::post('/products/{product}/stock', [StockController::class, 'store'])->name('stock.store');
    Route::get('/stock/history', [StockController::class, 'history'])->name('stock.history');

    // User Management (Super Admin only - protected by policy)
    Route::resource('users', UserController::class)->except(['show']);

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/stock-movements', [ReportController::class, 'stockMovements'])->name('stock-movements');
        Route::get('/inventory-valuation', [ReportController::class, 'inventoryValuation'])->name('inventory-valuation');
        Route::get('/low-stock', [ReportController::class, 'lowStock'])->name('low-stock');
        Route::get('/sales-summary', [ReportController::class, 'salesSummary'])->name('sales-summary');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
