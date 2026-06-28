@extends('admin.layouts.app')

@section('content')

<div class="mb-8">

    <p class="text-sm text-gray-500">
        Dashboard / Users / Edit User
    </p>

    <h1 class="text-3xl font-bold text-gray-800 mt-2">
        Edit User
    </h1>

    <p class="text-gray-500">
        Update user information and account settings.
    </p>

</div>

@if ($errors->any())

<div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">

    <h4 class="font-semibold mb-2">
        Please fix the following errors:
    </h4>

    <ul class="list-disc ml-5">

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>

</div>

@endif

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    <!-- Header -->

    <div class="px-8 py-6 border-b bg-gray-50">

        <h2 class="text-xl font-semibold text-gray-800">

            👤 User Information

        </h2>

    </div>

    <!-- Form -->

    <form method="POST"
          action="{{ route('users.update', $user) }}"
          class="p-8">

        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Name -->

            <div>

                <label class="block mb-2 font-semibold">

                    Full Name

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Email -->

            <div>

                <label class="block mb-2 font-semibold">

                    Email Address

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Role -->

            <div>

                <label class="block mb-2 font-semibold">

                    Role

                </label>

                <select
                    name="role"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    <option value="admin"
                        {{ $user->role=='admin' ? 'selected' : '' }}>
                        Administrator
                    </option>

                    <option value="branch_employee"
                        {{ $user->role=='branch_employee' ? 'selected' : '' }}>
                        Branch Employee
                    </option>

                </select>

            </div>

            <!-- Password -->

            <div>

                <label class="block mb-2 font-semibold">

                    New Password

                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Leave blank to keep current password"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

            </div>

        </div>

        <div class="mt-8 border-t pt-6 flex justify-between">

            <a href="{{ route('users.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                ← Cancel

            </a>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg shadow">

                💾 Update User

            </button>

        </div>

    </form>

</div>

@endsection