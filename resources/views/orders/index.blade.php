<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-4">Create New Order</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">User ID</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Total</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="border px-4 py-2">{{ $order->id }}</td>
                                    <td class="border px-4 py-2">{{ $order->user_id }}</td>
                                    <td class="border px-4 py-2">{{ $order->status }}</td>
                                    <td class="border px-4 py-2">{{ $order->total }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">View</a>
                                        @can('update', $order)
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('delete', $order)
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
