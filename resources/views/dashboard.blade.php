@extends('admin.layouts.app')

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard
    </h1>

    <p class="text-gray-500 mt-1">
        Welcome back, {{ auth()->user()->name }}.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600">
        <h4 class="text-gray-500 text-sm">Total Users</h4>
        <div class="text-4xl font-bold mt-2">
            {{ $totalUsers }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-600">
        <h4 class="text-gray-500 text-sm">Total Tickets</h4>
        <div class="text-4xl font-bold mt-2">
            {{ $totalTickets }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
        <h4 class="text-gray-500 text-sm">Open Tickets</h4>
        <div class="text-4xl font-bold mt-2">
            {{ $openTickets }}
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-500">
        <h4 class="text-gray-500 text-sm">Closed Tickets</h4>
        <div class="text-4xl font-bold mt-2">
            {{ $closedTickets }}
        </div>
    </div>

</div>

<div class="bg-white rounded-xl shadow mt-8 p-6">

    <h2 class="text-xl font-semibold mb-4">
        Welcome to PTMS Admin Panel
    </h2>

    <p class="text-gray-600">
        Use the sidebar to manage users, tickets and reports.
    </p>

</div>

@endsection