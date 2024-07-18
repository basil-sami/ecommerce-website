<!-- resources/views/admins/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admins List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admins.create') }}" class="btn btn-primary">Create New Admin</a>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td class="border px-4 py-2">{{ $admin->id }}</td>
                                    <td class="border px-4 py-2">{{ $admin->name }}</td>
                                    <td class="border px-4 py-2">{{ $admin->email }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-info">View</a>
                                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
