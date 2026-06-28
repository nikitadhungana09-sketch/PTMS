@extends('admin.layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            Ticket Details
        </h1>

        <a href="{{ route('tickets.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
            ← Back
        </a>

    </div>

    <div class="bg-white rounded-xl shadow p-8">

        <div class="mb-6">

            <h2 class="text-2xl font-bold">
                {{ $ticket->title }}
            </h2>

        </div>

        <div class="grid grid-cols-2 gap-8">

            <div>

                <p class="text-gray-500 mb-2">
                    Description
                </p>

                <div class="bg-gray-50 p-4 rounded-lg border">
                    {{ $ticket->description }}
                </div>

            </div>

            <div>

                <div class="mb-4">

                    <p class="text-gray-500">
                        Status
                    </p>

                    @if($ticket->status=='open')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                            🟢 Open
                        </span>

                    @elseif($ticket->status=='pending')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                            🟡 Pending
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">
                            🔴 Closed
                        </span>

                    @endif

                </div>

                <div class="mb-4">

                    <p class="text-gray-500">
                        Created By
                    </p>

                    <p class="font-semibold">
                        {{ $ticket->user->name }}
                    </p>

                </div>

                <div class="mb-4">

                    <p class="text-gray-500">
                        Created At
                    </p>

                    <p>
                        {{ $ticket->created_at->format('d M Y h:i A') }}
                    </p>

                </div>

                <div>

                    <p class="text-gray-500">
                        Last Updated
                    </p>

                    <p>
                        {{ $ticket->updated_at->format('d M Y h:i A') }}
                    </p>

                </div>

            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('tickets.edit', $ticket) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                ✏ Edit Ticket
            </a>

        </div>

    </div>

</div>

@endsection