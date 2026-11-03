<x-app-layout>
    <x-slot name="header">Low Stock Report</x-slot>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Low Stock Items</p>
                    <p class="text-2xl font-bold text-red-600">{{ $summary['total_low_stock'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Out of Stock</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $summary['critical_items'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Reorder Value</p>
                    <p class="text-2xl font-bold text-blue-600">৳{{ number_format($summary['total_reorder_value'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Supplier</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Current</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Minimum</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Shortage</th>
                    <th class="text-center px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition {{ $product->quantity == 0 ? 'bg-red-50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500 font-mono">{{ $product->sku }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->category?->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->supplier?->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold {{ $product->quantity == 0 ? 'text-red-600' : 'text-orange-600' }}">
                                {{ $product->quantity }} {{ $product->unit }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-gray-600">{{ $product->min_stock_level }} {{ $product->unit }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-red-600">
                            {{ $product->min_stock_level - $product->quantity }} {{ $product->unit }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('stock.create', $product) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Stock
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-green-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            All products are well stocked!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
