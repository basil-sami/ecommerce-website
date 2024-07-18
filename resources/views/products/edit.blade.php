<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-6">Edit Product</h1>
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="company_id" class="block text-gray-700 dark:text-gray-300">Company:</label>
                            <select name="company_id" id="company_id" class="form-select mt-1 block w-full">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 dark:text-gray-300">Description:</label>
                            <textarea name="description" id="description" class="form-textarea mt-1 block w-full" rows="3" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 dark:text-gray-300">Price:</label>
                            <input type="number" name="price" id="price" class="form-input mt-1 block w-full" step="0.01" value="{{ $product->price }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 dark:text-gray-300">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-input mt-1 block w-full" value="{{ $product->quantity }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 dark:text-gray-300">Product Image:</label>
                            <input type="file" name="image" id="image" class="form-input mt-1 block w-full">
                            @if($product->image_url)
                                <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-32 mt-4">
                            @endif
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
