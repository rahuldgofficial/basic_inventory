<x-app-layout>
    <x-slot name="header">Sales Summary Report</x-slot>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <form method="GET" class="flex gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate }}"
                    class="rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" name="end_date" value="{{ $endDate }}"
                    class="rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition">
                Apply Filters
            </button>
        </form>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Items Sold</p>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($summary['total_sold']) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Transactions</p>
                    <p class="text-2xl font-bold text-purple-600">{{ number_format($summary['total_transactions']) }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Est. Revenue</p>
                    <p class="text-2xl font-bold text-emerald-600">৳{{ number_format($summary['estimated_revenue'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Selling Products -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Top Selling Products</h3>
            </div>
            <div class="p-6">
                @if($productSales->count() > 0)
                    <div class="space-y-4">
                        @foreach($productSales as $index => $sale)
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $sale->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $sale->product->sku }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-emerald-600">{{ number_format($sale->total_sold) }} sold</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">No sales data for this period.</p>
                @endif
            </div>
        </div>

        <!-- Daily Sales -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Daily Sales</h3>
            </div>
            <div class="p-6">
                @if($dailySales->count() > 0)
                    <div class="space-y-3">
                        @foreach($dailySales->take(10) as $day)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($day->date)->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $day->transaction_count }} transactions</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-blue-600">{{ number_format($day->total_quantity) }} items</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">No sales data for this period.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
