<!-- resources/views/admins/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-6">Admin Details</h1>
                    <p><strong>ID:</strong> {{ $admin->id }}</p>
                    <p><strong>Username:</strong> {{ $admin->username }}</p>
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                    <div class="mt-4">
                        @can('update', $admin)
                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        <a href="{{ route('admins.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
