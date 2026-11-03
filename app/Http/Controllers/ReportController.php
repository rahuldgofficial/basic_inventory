<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        return view('reports.index');
    }

    /**
     * Stock movements report.
     */
    public function stockMovements(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        $query = StockMovement::with(['product', 'user'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $movements = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        // Summary stats
        $summary = [
            'total_in' => (clone $query)->where('type', 'in')->sum('quantity'),
            'total_out' => StockMovement::whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->where('type', 'out')
                ->sum('quantity'),
            'total_adjustments' => StockMovement::whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->where('type', 'adjustment')
                ->count(),
        ];

        $products = Product::orderBy('name')->get();

        return view('reports.stock-movements', compact('movements', 'summary', 'products', 'startDate', 'endDate'));
    }

    /**
     * Inventory valuation report.
     */
    public function inventoryValuation(Request $request)
    {
        $categoryId = $request->input('category_id');

        $query = Product::with(['category', 'supplier']);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->orderBy('name')->get();

        $summary = [
            'total_products' => $products->count(),
            'total_quantity' => $products->sum('quantity'),
            'total_cost_value' => $products->sum(fn($p) => $p->quantity * $p->cost_price),
            'total_sell_value' => $products->sum(fn($p) => $p->quantity * $p->selling_price),
            'potential_profit' => $products->sum(fn($p) => $p->quantity * ($p->selling_price - $p->cost_price)),
        ];

        $categories = Category::orderBy('name')->get();

        return view('reports.inventory-valuation', compact('products', 'summary', 'categories', 'categoryId'));
    }

    /**
     * Low stock report.
     */
    public function lowStock()
    {
        $products = Product::lowStock()
            ->with(['category', 'supplier'])
            ->orderBy('quantity', 'asc')
            ->get();

        $summary = [
            'total_low_stock' => $products->count(),
            'critical_items' => $products->filter(fn($p) => $p->quantity == 0)->count(),
            'total_reorder_value' => $products->sum(fn($p) => ($p->min_stock_level - $p->quantity) * $p->cost_price),
        ];

        return view('reports.low-stock', compact('products', 'summary'));
    }

    /**
     * Sales summary report (based on stock out movements).
     */
    public function salesSummary(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Get daily sales data
        $dailySales = StockMovement::where('type', 'out')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('COUNT(*) as transaction_count')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        // Get product-wise sales
        $productSales = StockMovement::where('type', 'out')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->select(
                'product_id',
                DB::raw('SUM(quantity) as total_sold')
            )
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();

        // Summary
        $summary = [
            'total_sold' => StockMovement::where('type', 'out')
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->sum('quantity'),
            'total_transactions' => StockMovement::where('type', 'out')
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->count(),
            'estimated_revenue' => StockMovement::where('type', 'out')
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->with('product')
                ->get()
                ->sum(fn($m) => $m->quantity * ($m->product->selling_price ?? 0)),
        ];

        return view('reports.sales-summary', compact('dailySales', 'productSales', 'summary', 'startDate', 'endDate'));
    }
}
