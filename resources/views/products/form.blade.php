<x-app-layout>
    <x-slot name="header">{{ $product->exists ? 'Edit Product' : 'Add New Product' }}</x-slot>

    <div class="max-w-3xl">
        <form method="POST" action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            @csrf
            @if($product->exists)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" required
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 font-mono @error('sku') border-red-500 @enderror">
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unit -->
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit *</label>
                    <select name="unit" id="unit" required class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        @php $units = ['pcs' => 'Pieces', 'kg' => 'Kilogram', 'g' => 'Gram', 'ltr' => 'Liter', 'ml' => 'Milliliter', 'box' => 'Box', 'pack' => 'Pack']; @endphp
                        @foreach($units as $value => $label)
                            <option value="{{ $value }}" {{ old('unit', $product->unit ?? 'pcs') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Cost Price -->
                <div>
                    <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-1">Cost Price (৳) *</label>
                    <input type="number" name="cost_price" id="cost_price" value="{{ old('cost_price', $product->cost_price ?? 0) }}" required step="0.01" min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('cost_price') border-red-500 @enderror">
                    @error('cost_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Selling Price -->
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price (৳) *</label>
                    <input type="number" name="selling_price" id="selling_price" value="{{ old('selling_price', $product->selling_price ?? 0) }}" required step="0.01" min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('selling_price') border-red-500 @enderror">
                    @error('selling_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Initial Quantity (only for new products) -->
                @if(!$product->exists)
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Initial Quantity *</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" required min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- Min Stock Level -->
                <div>
                    <label for="min_stock_level" class="block text-sm font-medium text-gray-700 mb-1">Minimum Stock Level *</label>
                    <input type="number" name="min_stock_level" id="min_stock_level" value="{{ old('min_stock_level', $product->min_stock_level ?? 0) }}" required min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('min_stock_level') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Alert when stock falls below this level</p>
                    @error('min_stock_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition">
                    {{ $product->exists ? 'Update Product' : 'Create Product' }}
                </button>
                <a href="{{ route('products.index') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
