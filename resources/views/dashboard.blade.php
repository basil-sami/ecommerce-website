<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Products Card -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Products</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Total Products: {{ $productsCount }}</p>
                            <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline">View Products</a>
                        </div>

                        <!-- Orders Card -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Orders</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Total Orders: {{ $ordersCount }}</p>
                            <a href="{{ route('orders.index') }}" class="text-blue-500 hover:underline">View Orders</a>
                        </div>

                        <!-- Companies Card -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Companies</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Total Companies: {{ $companiesCount }}</p>
                            <a href="{{ route('companies.index') }}" class="text-blue-500 hover:underline">View Companies</a>
                        </div>

                        <!-- Users Card -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Users</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Total Users: {{ $usersCount }}</p>
                            <a href="{{ route('users.index') }}" class="text-blue-500 hover:underline">View Users</a>
                        </div>

                        <!-- Admins Card -->
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Admins</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Admins Section</p>
                            <a href="{{ route('admins.index') }}" class="text-blue-500 hover:underline">View Admins</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
