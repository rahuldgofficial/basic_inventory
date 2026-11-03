<x-app-layout>
    <x-slot name="header">{{ $product->name }}</x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Product Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-500 font-mono">SKU: {{ $product->sku }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('stock.create', $product) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                            </svg>
                            Adjust Stock
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Category</p>
                        <p class="font-semibold text-gray-900">{{ $product->category?->name ?? '—' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Supplier</p>
                        <p class="font-semibold text-gray-900">{{ $product->supplier?->name ?? '—' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Unit</p>
                        <p class="font-semibold text-gray-900">{{ $product->unit }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500">Min Stock</p>
                        <p class="font-semibold text-gray-900">{{ $product->min_stock_level }}</p>
                    </div>
                </div>

                @if($product->description)
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-500 mb-1">Description</p>
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Stock Movements History -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Stock Movement History</h3>
                </div>
                <div class="p-6">
                    @if($stockMovements->count() > 0)
                        <div class="space-y-3">
                            @foreach($stockMovements as $movement)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center gap-4">
                                        @if($movement->type === 'in')
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8l-8-8-8 8"/>
                                                </svg>
                                            </div>
                                        @elseif($movement->type === 'out')
                                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m-8 8l8 8 8-8"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ ucfirst($movement->type) }}
                                                @if($movement->reference)
                                                    <span class="text-gray-500">• {{ $movement->reference }}</span>
                                                @endif
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                By {{ $movement->user->name }} • {{ $movement->created_at->format('M d, Y h:i A') }}
                                            </p>
                                            @if($movement->notes)
                                                <p class="text-sm text-gray-600 mt-1">{{ $movement->notes }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                            {{ $movement->type === 'in' ? 'bg-green-100 text-green-700' : ($movement->type === 'out' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ $movement->type === 'in' ? '+' : ($movement->type === 'out' ? '-' : '~') }}{{ $movement->quantity }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            No stock movements recorded yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Stock Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Current Stock</h3>
                <div class="text-center">
                    <p class="text-5xl font-bold {{ $product->isLowStock() ? 'text-red-600' : 'text-gray-900' }}">
                        {{ $product->quantity }}
                    </p>
                    <p class="text-gray-500 mt-1">{{ $product->unit }}</p>
                    @if($product->isLowStock())
                        <div class="mt-4 p-3 bg-red-50 rounded-lg">
                            <p class="text-sm font-medium text-red-700">⚠️ Low Stock Alert</p>
                            <p class="text-xs text-red-600">Below minimum level ({{ $product->min_stock_level }})</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pricing Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Pricing</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Cost Price</span>
                        <span class="font-semibold text-gray-900">৳{{ number_format($product->cost_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Selling Price</span>
                        <span class="font-semibold text-gray-900">৳{{ number_format($product->selling_price, 2) }}</span>
                    </div>
                    <hr>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Profit Margin</span>
                        <span class="font-semibold text-emerald-600">
                            ৳{{ number_format($product->selling_price - $product->cost_price, 2) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stock Value</span>
                        <span class="font-semibold text-gray-900">
                            ৳{{ number_format($product->quantity * $product->cost_price, 2) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('stock.create', $product) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Stock
                    </a>
                    <a href="{{ route('products.edit', $product) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Product
                    </a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
