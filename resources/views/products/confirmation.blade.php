<!-- resources/views/products/confirmation.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Purchase Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-4">Purchase Confirmation</h1>
                    <p>CONFIRM Your purchase of {{ $product->name }} ?</p>
                    <!-- Add more confirmation details if needed -->

                    <!-- Form to trigger purchase function -->
                    <form action="{{ route('products.purchase', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                            CONFIRM
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
