<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the inventory dashboard.
     */
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_suppliers' => Supplier::count(),
            'low_stock_count' => Product::lowStock()->count(),
            'total_stock_value' => Product::sum(\DB::raw('quantity * cost_price')),
        ];

        $lowStockProducts = Product::lowStock()
            ->with('category')
            ->orderBy('quantity', 'asc')
            ->take(5)
            ->get();

        $recentMovements = StockMovement::with(['product', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact('stats', 'lowStockProducts', 'recentMovements'));
    }
}
