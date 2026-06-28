@extends('admin.layouts.app')

@section('content')

<!-- Page Heading -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">
        Dashboard
    </h1>

    <p class="text-gray-500 mt-2">
        Welcome back, {{ auth()->user()->name }} 👋
    </p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <!-- Users -->
    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 border border-gray-100">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Total Users
                </p>

                <h2 class="text-4xl font-bold text-gray-800 mt-3">
                    {{ $totalUsers }}
                </h2>

                <p class="text-xs text-blue-600 mt-3">
                    Registered accounts
                </p>
            </div>

            <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                👥
            </div>
        </div>
    </div>

    <!-- Tickets -->
    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 border border-gray-100">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Total Tickets
                </p>

                <h2 class="text-4xl font-bold text-gray-800 mt-3">
                    {{ $totalTickets }}
                </h2>

                <p class="text-xs text-green-600 mt-3">
                    All tickets created
                </p>
            </div>

            <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                🎫
            </div>
        </div>
    </div>

    <!-- Open -->
    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 border border-gray-100">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Open Tickets
                </p>

                <h2 class="text-4xl font-bold text-gray-800 mt-3">
                    {{ $openTickets }}
                </h2>

                <p class="text-xs text-yellow-600 mt-3">
                    Awaiting action
                </p>
            </div>

            <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">
                ⏳
            </div>
        </div>
    </div>

    <!-- Closed -->
    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-6 border border-gray-100">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500 font-medium">
                    Closed Tickets
                </p>

                <h2 class="text-4xl font-bold text-gray-800 mt-3">
                    {{ $closedTickets }}
                </h2>

                <p class="text-xs text-red-600 mt-3">
                    Successfully resolved
                </p>
            </div>

            <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center text-2xl">
                ✅
            </div>
        </div>
    </div>

</div>

<!-- Welcome + Quick Actions -->
<div class="bg-white rounded-2xl shadow-sm mt-8 p-8 border border-gray-100">

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center">

        <!-- Left -->
        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Quick Actions
            </h2>

        </div>

        <!-- Right -->
        <div class="mt-6 lg:mt-0">

            <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                ● System Online

            </span>

        </div>

    </div>

    <!-- Quick Actions -->

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-10">

        <a href="{{ route('tickets.create') }}"
           class="group bg-blue-50 rounded-xl p-5 hover:bg-blue-600 transition">

            <div class="text-3xl">
                🎫
            </div>

            <h3 class="font-semibold mt-4 group-hover:text-white">
                Create Ticket
            </h3>

            <p class="text-sm text-gray-500 group-hover:text-blue-100 mt-1">
                Add a new support ticket
            </p>

        </a>

        <a href="{{ route('users.create') }}"
           class="group bg-green-50 rounded-xl p-5 hover:bg-green-600 transition">

            <div class="text-3xl">
                👤
            </div>

            <h3 class="font-semibold mt-4 group-hover:text-white">
                Add User
            </h3>

            <p class="text-sm text-gray-500 group-hover:text-green-100 mt-1">
                Register a new user
            </p>

        </a>

        <a href="{{ route('reports.index') }}"
           class="group bg-yellow-50 rounded-xl p-5 hover:bg-yellow-500 transition">

            <div class="text-3xl">
                📊
            </div>

            <h3 class="font-semibold mt-4 group-hover:text-white">
                Reports
            </h3>

            <p class="text-sm text-gray-500 group-hover:text-yellow-100 mt-1">
                View analytics
            </p>

        </a>

        <a href="{{ route('activity.index') }}"
           class="group bg-purple-50 rounded-xl p-5 hover:bg-purple-600 transition">

            <div class="text-3xl">
                📜
            </div>

            <h3 class="font-semibold mt-4 group-hover:text-white">
                Activity Log
            </h3>

            <p class="text-sm text-gray-500 group-hover:text-purple-100 mt-1">
                View recent activity
            </p>

        </a>

    </div>

</div>

<!-- Charts -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

    <!-- Ticket Status -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Ticket Status Overview
        </h2>

        <div class="flex justify-center">
            <div style="width:320px;height:320px;">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Monthly Tickets -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Tickets Created This Year
        </h2>

        <div style="height:320px;">
            <canvas id="monthlyChart"></canvas>
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    
        /*
        ===============================
        Doughnut Chart
        ===============================
        */
    
        const doughnut = document.getElementById('ticketChart');
    
        new Chart(doughnut, {
    
            type: 'doughnut',
    
            data: {
    
                labels: ['Open', 'Pending', 'Closed'],
    
                datasets: [{
    
                    data: [
                        {{ $ticketChart['open'] }},
                        {{ $ticketChart['pending'] }},
                        {{ $ticketChart['closed'] }}
                    ],
    
                    backgroundColor: [
                        '#22c55e',
                        '#f59e0b',
                        '#ef4444'
                    ],
    
                    hoverOffset: 18,
    
                    borderWidth: 0
    
                }]
    
            },
    
            options: {
    
                responsive: true,
    
                maintainAspectRatio: false,
    
                cutout: '72%',
    
                animation: {
    
                    animateRotate: true,
    
                    duration: 1500
    
                },
    
                plugins: {
    
                    legend: {
    
                        position: 'bottom',
    
                        labels: {
    
                            usePointStyle: true,
    
                            pointStyle: 'circle',
    
                            padding: 20
    
                        }
    
                    },
    
                    tooltip: {
    
                        backgroundColor: '#111827',
    
                        titleColor: '#fff',
    
                        bodyColor: '#fff',
    
                        cornerRadius: 10
    
                    }
    
                }
    
            }
    
        });
    
    
    
        /*
        ===============================
        Bar Chart
        ===============================
        */
    
        const bar = document.getElementById('monthlyChart');
    
        const ctx = bar.getContext('2d');
    
        const gradient = ctx.createLinearGradient(0,0,0,350);
    
        gradient.addColorStop(0,'#2563eb');
        gradient.addColorStop(1,'#60a5fa');
    
        new Chart(bar,{
    
            type:'bar',
    
            data:{
    
                labels:[
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Dec'
                ],
    
                datasets:[{
    
                    data:@json($monthlyTickets),
    
                    backgroundColor:gradient,
    
                    borderRadius:12,
    
                    borderSkipped:false,
    
                    maxBarThickness:38
    
                }]
    
            },
    
            options:{
    
                responsive:true,
    
                maintainAspectRatio:false,
    
                animation:{
                    duration:1800
                },
    
                plugins:{
    
                    legend:{
                        display:false
                    },
    
                    tooltip:{
                        backgroundColor:'#111827',
                        cornerRadius:10
                    }
    
                },
    
                scales:{
    
                    x:{
    
                        grid:{
                            display:false
                        }
    
                    },
    
                    y:{
    
                        beginAtZero:true,
    
                        ticks:{
                            precision:0
                        },
    
                        grid:{
                            color:'#e5e7eb'
                        }
    
                    }
    
                }
    
            }
    
        });
    
    });
    </script>

    <!-- Dashboard Insights -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-8">

    <h2 class="text-xl font-bold text-gray-800 mb-6">
        📈 Dashboard Insights
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="rounded-xl bg-blue-50 p-5">

            <div class="text-3xl">🎫</div>

            <h3 class="font-semibold mt-3">
                Tickets This Month
            </h3>

            <p class="text-3xl font-bold mt-2 text-blue-600">
                {{ $currentMonthTickets }}
            </p>

        </div>

        <div class="rounded-xl bg-green-50 p-5">

            <div class="text-3xl">✅</div>

            <h3 class="font-semibold mt-3">
                Resolution Rate
            </h3>

            <p class="text-3xl font-bold mt-2 text-green-600">
                {{ $resolvedPercentage }}%
            </p>

        </div>

        <div class="rounded-xl bg-yellow-50 p-5">

            <div class="text-3xl">⏳</div>

            <h3 class="font-semibold mt-3">
                Pending Tickets
            </h3>

            <p class="text-3xl font-bold mt-2 text-yellow-600">
                {{ $pendingTickets }}
            </p>

        </div>

        <div class="rounded-xl bg-purple-50 p-5">

            <div class="text-3xl">👤</div>

            <h3 class="font-semibold mt-3">
                Latest User
            </h3>

            <p class="font-bold mt-2 text-purple-600">
                {{ $latestUser?->name ?? 'N/A' }}
            </p>

        </div>

    </div>

</div>

<!-- Bottom Section -->
<div class="grid lg:grid-cols-2 gap-6 mt-8">

    <!-- Recent Tickets -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Recent Tickets
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                <tr>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Title</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">User</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                </tr>

                </thead>

                <tbody>

                @forelse($recentTickets as $ticket)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-6 py-4">
                            {{ $ticket->title }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $ticket->user->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4">

                            @if($ticket->status=='open')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                    Open
                                </span>

                            @elseif($ticket->status=='pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                                    Pending
                                </span>

                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                                    Closed
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-500">
                            No recent tickets.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Recent Activity
            </h2>
        </div>

        <div class="divide-y">

            @forelse($recentActivities as $activity)

                <div class="px-6 py-4">

                    <div class="font-semibold text-gray-800">
                        {{ $activity->action }}
                    </div>

                    <div class="text-sm text-gray-600 mt-1">
                        {{ $activity->description }}
                    </div>

                    <div class="text-xs text-gray-400 mt-2">
                        {{ $activity->created_at->diffForHumans() }}
                    </div>

                </div>

            @empty

                <div class="p-8 text-center text-gray-500">
                    No recent activity.
                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection