<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Companies List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create', App\Models\Company::class)
                        <a href="{{ route('companies.create') }}" class="btn btn-primary">Add New Company</a>
                    @endcan
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td class="border px-4 py-2">{{ $company->id }}</td>
                                    <td class="border px-4 py-2">{{ $company->name }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">View</a>
                                        @can('update', $company)
                                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('delete', $company)
                                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
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
