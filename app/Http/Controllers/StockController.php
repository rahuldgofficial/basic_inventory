<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Show stock adjustment form for a product.
     */
    public function create(Product $product)
    {
        return view('stock.form', [
            'product' => $product,
            'types' => StockMovement::types(),
        ]);
    }

    /**
     * Process stock adjustment.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => 'required|in:in,out,adjustment',
            'quantity' => 'required|integer|min:1',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $product) {
            // Create movement record
            $movement = StockMovement::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'reference' => $validated['reference'],
                'notes' => $validated['notes'],
            ]);

            // Update product quantity
            $newQuantity = $product->quantity;
            
            switch ($validated['type']) {
                case StockMovement::TYPE_IN:
                    $newQuantity += $validated['quantity'];
                    break;
                case StockMovement::TYPE_OUT:
                    $newQuantity -= $validated['quantity'];
                    break;
                case StockMovement::TYPE_ADJUSTMENT:
                    // For adjustment, the quantity is the new absolute value
                    $newQuantity = $validated['quantity'];
                    break;
            }

            // Ensure quantity doesn't go negative
            $product->update([
                'quantity' => max(0, $newQuantity),
            ]);
        });

        return redirect()->route('products.show', $product)
            ->with('success', 'Stock updated successfully.');
    }

    /**
     * Show stock movement history.
     */
    public function history(Request $request)
    {
        $movements = StockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(20);

        return view('stock.history', compact('movements'));
    }
}
