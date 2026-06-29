@extends('admin.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Create Ticket
    </h1>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <!-- Title -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>

                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Description -->
            <div class="mb-6">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <!-- Priority -->
            <div class="mb-8">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Priority
                </label>

                <select
                    name="priority"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    <option value="Low">🟢 Low</option>
                    <option value="Medium" selected>🟡 Medium</option>
                    <option value="High">🟠 High</option>
                    <option value="Critical">🔴 Critical</option>

                </select>

            </div>

            <!-- Buttons -->
            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">

                    Create Ticket

                </button>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg transition">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection