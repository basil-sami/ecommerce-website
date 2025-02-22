<!-- resources/views/companies/edit.blade.php -->

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Company') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-semibold mb-6">Edit Company</h1>
                        <form action="{{ route('companies.update', $company->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $company->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $company->address }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $company->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website:</label>
                                <input type="url" name="website" id="website" class="form-control" value="{{ $company->website }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ $company->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Company</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>



