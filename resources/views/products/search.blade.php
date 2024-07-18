<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    @if($productsWithinRange->isNotEmpty())
                        <h2 class="text-xl font-semibold mb-4 text-green-600">Products within Price Range ({{$minPrice}}$ - {{$maxPrice}}$)</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($productsWithinRange as $product)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-50 h-40 mb-4 rounded-lg">
                                   
                                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $product->name }}</h2>
                                    <p class="text-gray-600">{{ $product->description }}</p>
                                    <p class="text-green-600 font-semibold">${{ $product->price }}</p>
                                    <a href="{{ route('products.show', $product->id) }}" class="mt-2 text-blue-500 hover:underline">View Details</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($productsOutsideRange->isNotEmpty())
                        <h2 class="text-xl font-semibold mt-8 mb-4 text-red-600">Products outside Price Range ({{$minPrice}}$ - {{$maxPrice}}$)</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($productsOutsideRange as $product)
                                <div class="bg-white rounded-lg shadow-md p-4">
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-50 h-40 mb-4 rounded-lg">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $product->name }}</h2>
                                    <p class="text-gray-600">{{ $product->description }}</p>
                                    <p class="text-red-600 font-semibold">${{ $product->price }}</p>
                                    <a href="{{ route('products.show', $product->id) }}" class="mt-2 text-blue-500 hover:underline">View Details</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($productsWithinRange->isEmpty() && $productsOutsideRange->isEmpty())
                        <p class="mt-8 text-lg font-semibold">No products found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
