<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <h1>User Details</h1>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <div class="mt-4">
        @can('edit', $user)
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
        @endcan
        @if($user->id === Auth::user()->id )
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your user?')">Delete</button>
                                        </form>
                                    @endif
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</x-app-layout>
