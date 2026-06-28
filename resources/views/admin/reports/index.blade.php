@extends('admin.layouts.app')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Reports
    </h1>

    <p class="text-gray-500 mt-1">
        View ticket statistics and system overview.
    </p>

</div>

<!-- Statistics Cards -->

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">

    <!-- Total Tickets -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4 border-blue-600">

        <p class="text-gray-500 text-sm">
            Total Tickets
        </p>

        <h2 class="text-4xl font-bold mt-2">
            {{ $totalTickets }}
        </h2>

    </div>

    <!-- Open -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4 border-green-600">

        <p class="text-gray-500 text-sm">
            Open Tickets
        </p>

        <h2 class="text-4xl font-bold mt-2 text-green-600">
            {{ $openTickets }}
        </h2>

    </div>

    <!-- Pending -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4 border-yellow-500">

        <p class="text-gray-500 text-sm">
            Pending Tickets
        </p>

        <h2 class="text-4xl font-bold mt-2 text-yellow-500">
            {{ $pendingTickets }}
        </h2>

    </div>

    <!-- Closed -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4 border-red-500">

        <p class="text-gray-500 text-sm">
            Closed Tickets
        </p>

        <h2 class="text-4xl font-bold mt-2 text-red-500">
            {{ $closedTickets }}
        </h2>

    </div>

    <!-- Users -->
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6 border-l-4 border-purple-600">

        <p class="text-gray-500 text-sm">
            Registered Users
        </p>

        <h2 class="text-4xl font-bold mt-2 text-purple-600">
            {{ $totalUsers }}
        </h2>

    </div>

</div>

<!-- Report Summary -->

<div class="bg-white rounded-xl shadow-md overflow-hidden">

    <div class="border-b px-6 py-4">

        <h2 class="text-xl font-semibold">
            Report Summary
        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left px-6 py-3">
                        Category
                    </th>

                    <th class="text-left px-6 py-3">
                        Count
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">Total Tickets</td>
                    <td class="px-6 py-4 font-semibold">{{ $totalTickets }}</td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">Open Tickets</td>
                    <td class="px-6 py-4 font-semibold text-green-600">{{ $openTickets }}</td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">Pending Tickets</td>
                    <td class="px-6 py-4 font-semibold text-yellow-500">{{ $pendingTickets }}</td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">Closed Tickets</td>
                    <td class="px-6 py-4 font-semibold text-red-500">{{ $closedTickets }}</td>
                </tr>

                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 py-4">Registered Users</td>
                    <td class="px-6 py-4 font-semibold text-purple-600">{{ $totalUsers }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

<!-- Charts -->

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <!-- Bar Chart -->

    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6">

        <h3 class="text-lg font-semibold mb-4">
            Tickets Status Overview
        </h3>

        <div class="h-56">
            <canvas id="statusChart"></canvas>
        </div>

    </div>

    <!-- Pie Chart -->

    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition p-6">

        <h3 class="text-lg font-semibold mb-4">
            Current Distribution of Tickets
        </h3>

        <div class="h-72 flex justify-center items-center">
            <canvas id="pieChart"></canvas>
        </div>

    </div>

</div>

<!-- Export Buttons -->

<div class="flex justify-end gap-4 mt-6">

    <button
        class="bg-green-600 hover:bg-green-700 transition text-white px-6 py-3 rounded-lg shadow-md">

        📄 Export PDF

    </button>

    <button
        class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-3 rounded-lg shadow-md">

        📊 Export Excel

    </button>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const openTickets = {{ $openTickets }};
const pendingTickets = {{ $pendingTickets }};
const closedTickets = {{ $closedTickets }};

// Bar Chart

new Chart(document.getElementById('statusChart'), {

    type: 'bar',

    data: {

        labels: ['Open', 'Pending', 'Closed'],

        datasets: [{

            label: 'Tickets',

            data: [openTickets, pendingTickets, closedTickets],

            backgroundColor: [

                '#22c55e',
                '#f59e0b',
                '#ef4444'

            ],

            borderRadius: 8

        }]

    },

    options: {

responsive: true,
maintainAspectRatio: false,

plugins: {

    legend: {
        display: false
    }

},

scales: {

    y: {
        beginAtZero: true,
        ticks: {
            precision: 0
        }
    }

}

}

});

// Pie Chart

new Chart(document.getElementById('pieChart'), {

    type: 'pie',

    data: {

        labels: ['Open', 'Pending', 'Closed'],

        datasets: [{

            data: [openTickets, pendingTickets, closedTickets],

            backgroundColor: [

                '#22c55e',
                '#f59e0b',
                '#ef4444'

            ]

        }]

    },

    options: {

responsive: true,
maintainAspectRatio: false,

plugins: {

    legend: {

        position: 'bottom'

    }

}

}

});

</script>

@endsection