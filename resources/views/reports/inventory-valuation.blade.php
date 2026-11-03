<x-app-layout>
    <x-slot name="header">Inventory Valuation Report</x-slot>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <form method="GET" class="flex gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Category</label>
                <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                Apply Filter
            </button>
        </form>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Products</p>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($summary['total_products']) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Quantity</p>
            <p class="text-2xl font-bold text-blue-600">{{ number_format($summary['total_quantity']) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Cost Value</p>
            <p class="text-2xl font-bold text-gray-900">৳{{ number_format($summary['total_cost_value'], 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Selling Value</p>
            <p class="text-2xl font-bold text-emerald-600">৳{{ number_format($summary['total_sell_value'], 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Potential Profit</p>
            <p class="text-2xl font-bold text-purple-600">৳{{ number_format($summary['potential_profit'], 2) }}</p>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Qty</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Cost Price</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Sell Price</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Cost Value</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Sell Value</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500 font-mono">{{ $product->sku }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->category?->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-right font-semibold {{ $product->isLowStock() ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $product->quantity }} {{ $product->unit }}
                        </td>
                        <td class="px-6 py-4 text-right text-gray-600">৳{{ number_format($product->cost_price, 2) }}</td>
                        <td class="px-6 py-4 text-right text-gray-600">৳{{ number_format($product->selling_price, 2) }}</td>
                        <td class="px-6 py-4 text-right font-medium text-gray-900">৳{{ number_format($product->quantity * $product->cost_price, 2) }}</td>
                        <td class="px-6 py-4 text-right font-medium text-emerald-600">৳{{ number_format($product->quantity * $product->selling_price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
