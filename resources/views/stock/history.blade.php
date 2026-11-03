<x-app-layout>
    <x-slot name="header">Stock Movement History</x-slot>

    <!-- Movements Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantity</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Reference</th>
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">By</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($movements as $movement)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $movement->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $movement->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('products.show', $movement->product) }}" class="font-medium text-gray-900 hover:text-emerald-600">
                                {{ $movement->product->name }}
                            </a>
                            <div class="text-xs text-gray-500 font-mono">{{ $movement->product->sku }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($movement->type === 'in')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                    </svg>
                                    Stock In
                                </span>
                            @elseif($movement->type === 'out')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                    </svg>
                                    Stock Out
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Adjustment
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-lg font-semibold {{ $movement->type === 'in' ? 'text-green-600' : ($movement->type === 'out' ? 'text-red-600' : 'text-yellow-600') }}">
                                {{ $movement->type === 'in' ? '+' : ($movement->type === 'out' ? '-' : '~') }}{{ $movement->quantity }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($movement->reference)
                                <span class="text-gray-700">{{ $movement->reference }}</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                            @if($movement->notes)
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($movement->notes, 30) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-700">{{ $movement->user->name }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            No stock movements recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($movements->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $movements->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
