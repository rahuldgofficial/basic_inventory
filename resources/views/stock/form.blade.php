<x-app-layout>
    <x-slot name="header">Adjust Stock: {{ $product->name }}</x-slot>

    <div class="max-w-xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <!-- Current Stock Info -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Current Stock</p>
                    <p class="text-2xl font-bold {{ $product->isLowStock() ? 'text-red-600' : 'text-gray-900' }}">
                        {{ $product->quantity }} {{ $product->unit }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">SKU</p>
                    <p class="font-mono text-gray-700">{{ $product->sku }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('stock.store', $product) }}">
                @csrf

                <div class="space-y-6">
                    <!-- Movement Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Movement Type *</label>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($types as $value => $label)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="type" value="{{ $value }}" {{ old('type', 'in') == $value ? 'checked' : '' }}
                                        class="peer sr-only">
                                    <div class="p-4 rounded-lg border-2 border-gray-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition text-center">
                                        @if($value === 'in')
                                            <svg class="w-6 h-6 mx-auto mb-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8l-8-8-8 8"/>
                                            </svg>
                                        @elseif($value === 'out')
                                            <svg class="w-6 h-6 mx-auto mb-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m-8 8l8 8 8-8"/>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 mx-auto mb-1 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        @endif
                                        <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" required min="1"
                            class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 text-lg @error('quantity') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">For adjustments, enter the new total quantity</p>
                        @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Reference -->
                    <div>
                        <label for="reference" class="block text-sm font-medium text-gray-700 mb-1">Reference (Invoice/PO #)</label>
                        <input type="text" name="reference" id="reference" value="{{ old('reference') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" id="notes" rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
                        Update Stock
                    </button>
                    <a href="{{ route('products.show', $product) }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
