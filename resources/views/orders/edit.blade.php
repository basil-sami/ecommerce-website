<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-6">Edit Order</h1>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 dark:text-gray-300">User:</label>
                            <select name="user_id" id="user_id" class="form-select mt-1 block w-full" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 dark:text-gray-300">Status:</label>
                            <input type="text" name="status" id="status" class="form-input mt-1 block w-full" value="{{ $order->status }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="total" class="block text-gray-700 dark:text-gray-300">Total:</label>
                            <input type="number" name="total" id="total" class="form-input mt-1 block w-full" step="0.01" value="{{ $order->total }}" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
