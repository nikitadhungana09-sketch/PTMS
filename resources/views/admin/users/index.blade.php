@extends('admin.layouts.app')

@section('content')

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
    {{ session('error') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            User Management
        </h1>

        <p class="text-gray-500">
            Manage all system users.
        </p>
    </div>

    <a href="{{ route('users.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow">
        + Create User
    </a>

</div>

<div class="bg-white rounded-xl shadow">

    <div class="p-5 border-b">

        <input
            type="text"
            placeholder="Search users..."
            class="w-full border rounded-lg px-4 py-2">

    </div>

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="text-left p-4">ID</th>

                <th class="text-left p-4">Name</th>

                <th class="text-left p-4">Email</th>

                <th class="text-left p-4">Role</th>

                <th class="text-center p-4">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($users as $user)

            <tr class="border-t hover:bg-gray-50">

                <td class="p-4">
                    {{ $user->id }}
                </td>

                <td class="p-4 font-semibold">
                    {{ $user->name }}
                </td>

                <td class="p-4">
                    {{ $user->email }}
                </td>

                <td class="p-4">

                    @if($user->role=='admin')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Admin
                        </span>

                    @else

                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                            {{ ucfirst($user->role) }}
                        </span>

                    @endif

                </td>

                <td class="p-4 text-center">

                    <a href="{{ route('users.edit', $user) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form action="{{ route('users.destroy', $user) }}"
      method="POST"
      class="inline"
      onsubmit="return confirm('Are you sure you want to delete this user?');">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded ml-2">
        Delete
    </button>

</form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center p-6 text-gray-500">

                    No users found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection