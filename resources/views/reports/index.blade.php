<x-app-layout>
    <x-slot name="header">Reports</x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stock Movements Report -->
        <a href="{{ route('reports.stock-movements') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:border-blue-300 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Stock Movements</h3>
            <p class="text-sm text-gray-500">Track all stock in/out transactions with date filters</p>
        </a>

        <!-- Inventory Valuation -->
        <a href="{{ route('reports.inventory-valuation') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:border-emerald-300 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-emerald-200 transition">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Inventory Valuation</h3>
            <p class="text-sm text-gray-500">View total inventory value by cost and selling price</p>
        </a>

        <!-- Low Stock Report -->
        <a href="{{ route('reports.low-stock') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:border-red-300 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-red-200 transition">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Low Stock Alert</h3>
            <p class="text-sm text-gray-500">Products below minimum stock level</p>
        </a>

        <!-- Sales Summary -->
        <a href="{{ route('reports.sales-summary') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:border-purple-300 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-200 transition">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-1">Sales Summary</h3>
            <p class="text-sm text-gray-500">Daily sales and top selling products</p>
        </a>
    </div>
</x-app-layout>
