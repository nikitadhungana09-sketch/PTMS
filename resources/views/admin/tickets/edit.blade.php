@extends('admin.layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Ticket
            </h1>

            <p class="text-gray-500">
                Update ticket information.
            </p>
        </div>

        <a href="{{ route('tickets.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
            ← Back
        </a>

    </div>

    @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">

            <strong>Please fix the following errors:</strong>

            <ul class="list-disc ml-5 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white rounded-xl shadow p-8">

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $ticket->title) }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('description', $ticket->description) }}</textarea>

            </div>

            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>
                        Open
                    </option>

                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>
                        Closed
                    </option>

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">

                    Update Ticket

                </button>

                <a href="{{ route('tickets.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection