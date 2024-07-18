<!-- resources/views/products/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-4">Product Details</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            @if($product->image_path)
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full object-contain sm:max-w-sm mx-auto mb-4">
                                </a>
                            @else
                                <div class="w-full h-64 bg-gray-300 flex items-center justify-center mb-4">
                                    <span class="text-gray-600">No Image Available</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-span-1">
                            <p><strong>ID:</strong> {{ $product->id }}</p>
                            <p><strong>Name:</strong> {{ $product->name }}</p>
                            <p><strong>Description:</strong> {{ $product->description }}</p>
                            <p><strong>Price:</strong> {{ $product->price }}</p>
                            <p><strong>Available Quantity:</strong> {{ $product->quantity }}</p>
                            
                            <form action="{{ route('products.confirmation', ['product' => $product->id]) }}" method="GET" class="mt-6 flex items-center space-x-2">
                                @csrf
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="w-16 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Purchase
                                </button>
                                @can('update', $product)
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                                @endcan
                                <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Back to List
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Products Section -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Similar Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($product->similarProducts() as $similarProduct)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ route('products.show', $similarProduct->id) }}">
                            @if($similarProduct->image_path)
                                <img src="{{ Storage::url($similarProduct->image_path) }}" alt="{{ $similarProduct->name }}" class="w-full h-40 object-contain mb-4">
                            @else
                                <div class="w-full h-40 bg-gray-300 flex items-center justify-center mb-4">
                                    <span class="text-gray-600">No Image Available</span>
                                </div>
                            @endif
                        </a>
                        <h2 class="text-xl font-semibold">{{ $similarProduct->name }}</h2>
                        <p class="text-gray-700">{{ $similarProduct->description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-500">Price: ${{ $similarProduct->price }}</span>
                            <a href="{{ route('products.show', $similarProduct->id) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
