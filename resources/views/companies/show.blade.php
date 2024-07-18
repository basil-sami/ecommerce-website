<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin - Company Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-semibold mb-6">Company Details</h1>
                    <div class="mb-3">
                        <label for="id" class="form-label">ID:</label>
                        <p>{{ $company->id }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <p>{{ $company->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <p>{{ $company->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <p>{{ $company->address }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone:</label>
                        <p>{{ $company->phone }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website:</label>
                        <p>{{ $company->website }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <p>{{ $company->description }}</p>
                    </div>

                    <h2 class="text-xl font-semibold mb-4">Products</h2>
                    @if ($company->products->count() > 0)
                        <ul>
                            @foreach ($company->products as $product)
                                <li>{{ $product->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No products available for this company.</p>
                    @endif

                    <div class="mt-4">
                        @can('update', $company)
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
