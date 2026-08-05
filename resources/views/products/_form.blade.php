<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- SKU --}}
    <div>
        <label class="block font-medium mb-1">SKU</label>
        <input type="text"
               name="sku"
               value="{{ old('sku', $product->sku ?? '') }}"
               class="w-full rounded border-gray-300">
        @error('sku')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Barcode --}}
    <div>
        <label class="block font-medium mb-1">Barcode</label>
        <input type="text"
               name="barcode"
               value="{{ old('barcode', $product->barcode ?? '') }}"
               class="w-full rounded border-gray-300">
        @error('barcode')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Product Name --}}
    <div>
        <label class="block font-medium mb-1">Product Name <span class="text-red-500">*</span></label>
        <input type="text"
               name="product_name"
               value="{{ old('product_name', $product->product_name ?? '') }}"
               class="w-full rounded border-gray-300"
               required>
        @error('product_name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    {{-- Category --}}
    <div>
        <label class="block font-medium mb-1">Category</label>
        <input type="text"
               name="category"
               value="{{ old('category', $product->category ?? '') }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Brand --}}
    <div>
        <label class="block font-medium mb-1">Brand</label>
        <input type="text"
               name="brand"
               value="{{ old('brand', $product->brand ?? '') }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Unit --}}
    <div>
        <label class="block font-medium mb-1">Unit</label>

        <select name="unit" class="w-full rounded border-gray-300">

            @foreach(['PCS','KG','Box','Litre'] as $unit)

                <option value="{{ $unit }}"
                    {{ old('unit', $product->unit ?? 'PCS') == $unit ? 'selected' : '' }}>
                    {{ $unit }}
                </option>

            @endforeach

        </select>

    </div>

    {{-- Cost Price --}}
    <div>
        <label class="block font-medium mb-1">Cost Price</label>
        <input type="number"
               step="0.01"
               name="cost_price"
               value="{{ old('cost_price', $product->cost_price ?? 0) }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Selling Price --}}
    <div>
        <label class="block font-medium mb-1">Selling Price</label>
        <input type="number"
               step="0.01"
               name="selling_price"
               value="{{ old('selling_price', $product->selling_price ?? 0) }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Stock --}}
    <div>
        <label class="block font-medium mb-1">Stock</label>
        <input type="number"
               name="stock"
               value="{{ old('stock', $product->stock ?? 0) }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Minimum Stock --}}
    <div>
        <label class="block font-medium mb-1">Minimum Stock</label>
        <input type="number"
               name="minimum_stock"
               value="{{ old('minimum_stock', $product->minimum_stock ?? 5) }}"
               class="w-full rounded border-gray-300">
    </div>

    {{-- Status --}}
    <div>
        <label class="block font-medium mb-1">Status</label>

        <select name="status"
                class="w-full rounded border-gray-300">

            <option value="Active"
                {{ old('status', $product->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="Inactive"
                {{ old('status', $product->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

    {{-- Product Image --}}
    <div>
        <label class="block font-medium mb-1">Product Image</label>

        <input type="file"
               name="image"
               class="w-full border rounded p-2">

        @if(isset($product) && $product->image)

            <img src="{{ $product->image_url }}"
                 class="w-24 h-24 mt-3 rounded border object-cover">

        @endif
    </div>

</div>

{{-- Description --}}

<div class="mt-6">

    <label class="block font-medium mb-1">

        Description

    </label>

    <textarea
        name="description"
        rows="5"
        class="w-full rounded border-gray-300">{{ old('description', $product->description ?? '') }}</textarea>

</div>

<div class="mt-6">

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

        Save Product

    </button>

</div>