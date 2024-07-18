<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Search Results for "{{ $query }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($products->isEmpty())
                <p class="text-gray-700">No products found matching "{{ $query }}".</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover mb-4">
                                <p class="text-gray-700">{{ $product->description }}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-gray-500">Price: ${{ $product->price }}</span>
                                    <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
