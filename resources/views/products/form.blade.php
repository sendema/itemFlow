<div class="space-y-6">
    <div>
        <label class="block text-sm font-medium text-gray-700">Article</label>
        <input type="text"
               name="article"
               value="{{ old('article', $product->article ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            {{ config('products.role') !== 'admin' ? 'disabled' : '' }}>
        @error('article')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="available" {{ (old('status', $product->status ?? '') === 'available') ? 'selected' : '' }}>
                Available
            </option>
            <option value="unavailable" {{ (old('status', $product->status ?? '') === 'unavailable') ? 'selected' : '' }}>
                Unavailable
            </option>
        </select>
        @error('status')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Color</label>
        <input type="text" name="data[color]" value="{{ old('data.color', $product->data['color'] ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('data.color')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Size</label>
        <input type="text" name="data[size]" value="{{ old('data.size', $product->data['size'] ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('data.size')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
