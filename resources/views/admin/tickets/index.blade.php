@extends('admin.layouts.app')

@section('content')

@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-3 rounded-lg">
        {{ session('error') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Tickets
        </h1>

        <p class="text-gray-500">
            Manage all support tickets.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8 mb-8">

            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600">
                <p class="text-gray-500 text-sm">Total Tickets</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalTickets }}</h2>
            </div>
        
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-600">
                <p class="text-gray-500 text-sm">Open</p>
                <h2 class="text-3xl font-bold mt-2">{{ $openTickets }}</h2>
            </div>
        
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
                <p class="text-gray-500 text-sm">Pending</p>
                <h2 class="text-3xl font-bold mt-2">{{ $pendingTickets }}</h2>
            </div>
        
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-500">
                <p class="text-gray-500 text-sm">Closed</p>
                <h2 class="text-3xl font-bold mt-2">{{ $closedTickets }}</h2>
            </div>
        
        </div>

    </div>

    <a href="{{ route('tickets.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow">
        + Create Ticket
    </a>

</div>

<div class="p-6 border-b">

    <form method="GET" class="flex flex-col md:flex-row gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by title..."
            class="flex-1 border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

        <select
            name="status"
            class="border rounded-lg px-4 py-3">

            <option value="">All Status</option>

            <option value="open"
                {{ request('status')=='open' ? 'selected' : '' }}>
                Open
            </option>

            <option value="pending"
                {{ request('status')=='pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="closed"
                {{ request('status')=='closed' ? 'selected' : '' }}>
                Closed
            </option>

        </select>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg">

            Filter

        </button>

        <a href="{{ route('tickets.index') }}"
           class="bg-gray-200 hover:bg-gray-300 px-6 rounded-lg flex items-center justify-center">

            Reset

        </a>

    </form>

</div>

    <table class="w-full">

    <thead class="bg-gray-100">

        <tr>

            <th class="text-left p-4">ID</th>

            <th class="text-left p-4">Ticket</th>

            <th class="text-left p-4">Priority</th>
            <th class="text-left p-4">Status</th>

            <th class="text-left p-4">Created By</th>

            <th class="text-left p-4">Created at</th>

            <th class="text-center p-4">Actions</th>

        </tr>

    </thead>

    <tbody>

    @forelse($tickets as $ticket)

        <tr class="border-t hover:bg-gray-50">

            <td class="p-4 font-semibold">
                #{{ $ticket->id }}
            </td>

            <td class="p-4">

                <h3 class="font-semibold text-gray-800">
                    {{ $ticket->title }}
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    {{ Str::limit($ticket->description, 60) }}
                </p>

            </td>

            <!-- Priority -->
            <td class="p-4">

            @if($ticket->priority == 'Low')

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
            🟢 Low
            </span>

            @elseif($ticket->priority == 'Medium')

            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
            🟡 Medium
            </span>

            @elseif($ticket->priority == 'High')

            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">
            🟠 High
            </span>

            @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
            🔴 Critical
        </span>

    @endif

</td>

<!-- Status -->
<td class="p-4">

    @if($ticket->status == 'open')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            🟢 Open
        </span>

    @elseif($ticket->status == 'pending')

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
            🟡 Pending
        </span>

    @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            🔴 Closed
        </span>

    @endif

</td>

            <td class="p-4">

                <div class="font-medium">
                    {{ $ticket->user->name }}
                </div>

                <div class="text-sm text-gray-500">
                    {{ $ticket->user->email }}
                </div>

            </td>

            <td class="p-4 text-gray-500">

                {{ $ticket->created_at->format('d M Y') }}

                <br>

                <span class="text-xs">

                    {{ $ticket->created_at->format('h:i A') }}

                </span>

            </td>

            <td class="p-4">

                <div class="flex justify-center gap-2">

                    <a href="{{ route('tickets.show', $ticket) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg">
                        View
                    </a>
 
                    <a href="{{ route('tickets.edit', $ticket) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg shadow transition duration-200">
                        ✏ Edit
                    </a>
                
                    <form action="{{ route('tickets.destroy', $ticket) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this ticket?')">
                
                        @csrf
                        @method('DELETE')
                
                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg shadow transition duration-200">
                            🗑 Delete
                        </button>
                
                    </form>
                
                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7" class="text-center py-10 text-gray-500">
                📭 No tickets found.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div class="p-5 border-t">

    {{ $tickets->links() }}

</div>

</div>

@endsection