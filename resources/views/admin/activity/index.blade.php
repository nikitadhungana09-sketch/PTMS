@extends('admin.layouts.app')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Activity Log
            </h1>

            <p class="text-gray-500 mt-1">
                View all activities performed in the system.
            </p>

        </div>

    </div>

    <!-- Search -->
    <div class="bg-white rounded-xl shadow p-5">

        <form method="GET">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search activity..."
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg">
                    Search
                </button>

                <a href="{{ route('activity.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 px-6 rounded-lg flex items-center">
                    Reset
                </a>

            </div>

        </form>

    </div>

    <!-- Activity Table -->
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-4 text-left">User</th>
                    <th class="px-6 py-4 text-left">Action</th>
                    <th class="px-6 py-4 text-left">Description</th>
                    <th class="px-6 py-4 text-left">Date & Time</th>

                </tr>

            </thead>

            <tbody>

                @forelse($activities as $activity)

                <tr class="border-t hover:bg-gray-50">

                    <!-- User -->
                    <td class="px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">

                                {{ strtoupper(substr($activity->user->name ?? 'U',0,1)) }}

                            </div>

                            <div>

                                <p class="font-semibold">
                                    {{ $activity->user->name ?? 'Unknown' }}
                                </p>

                            </div>

                        </div>

                    </td>

                    <!-- Action -->
                    <td class="px-6 py-4">

                        @if(str_contains($activity->action,'Created'))

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                {{ $activity->action }}
                            </span>

                        @elseif(str_contains($activity->action,'Updated'))

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                {{ $activity->action }}
                            </span>

                        @elseif(str_contains($activity->action,'Deleted'))

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                {{ $activity->action }}
                            </span>

                        @else

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $activity->action }}
                            </span>

                        @endif

                    </td>

                    <!-- Description -->
                    <td class="px-6 py-4 text-gray-700">
                        {{ $activity->description }}
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4 text-gray-500">
                        {{ $activity->created_at->format('d M Y, h:i A') }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-12 text-gray-500">

                        No activity found.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Pagination -->
    <div>

        {{ $activities->links() }}

    </div>

</div>

@endsection