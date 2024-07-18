<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Available Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Products Sorted by Views</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($productsByViews as $product)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                                <span class="text-gray-500">{{ $product->views }} Views</span>
                            </div>
                            @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover mb-4">
                            @endif
                            <p class="text-gray-700 dark:text-gray-300">{{ $product->description }}</p>
                            <p class="text-gray-500 dark:text-gray-400">Category: {{ $product->category->name }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-gray-500 dark:text-gray-400">Price: ${{ $product->price }}</span>
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Repeat the above structure for other sorting criteria if needed -->
        </div>
    </div>
</x-app-layout>
