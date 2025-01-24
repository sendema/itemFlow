@extends('products.layout')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between mb-6">
                        <h2 class="text-2xl font-bold">Product Details</h2>
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="https://placehold.co/600x400" alt="{{ $product->name }}" class="w-full rounded-lg">
                        </div>
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                                <p class="text-gray-600">Article: {{ $product->article }}</p>
                            </div>

                            <div>
                            <span class="px-3 py-1 rounded text-sm {{ $product->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                            </div>

                            <div class="border-t pt-4">
                                <h4 class="font-semibold mb-2">Specifications:</h4>
                                <p class="text-gray-600">Color: {{ $product->data['color'] }}</p>
                                <p class="text-gray-600">Size: {{ $product->data['size'] }}</p>
                            </div>

                            <div class="flex space-x-2 pt-4">
                                <a href="{{ route('products.edit', $product) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
