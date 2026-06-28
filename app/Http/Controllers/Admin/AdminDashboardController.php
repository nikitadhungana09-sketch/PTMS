<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ticket;
use App\Models\ActivityLog;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Dashboard Statistics
        $totalUsers = User::count();
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();
        $pendingTickets = Ticket::where('status', 'pending')->count();

        // Latest Tickets
        $recentTickets = Ticket::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Recent Activity
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Ticket Status Chart
        $ticketChart = [
        'open' => Ticket::where('status', 'open')->count(),
        'pending' => Ticket::where('status', 'pending')->count(),
        'closed' => Ticket::where('status', 'closed')->count(),
        ];    

        $monthlyTickets = [];

for ($i = 1; $i <= 12; $i++) {

    $monthlyTickets[] = Ticket::whereMonth('created_at', $i)
        ->whereYear('created_at', now()->year)
        ->count();

}

$currentMonthTickets = Ticket::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();

$resolvedPercentage = $totalTickets > 0
    ? round(($closedTickets / $totalTickets) * 100)
    : 0;

$latestUser = User::latest()->first();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalTickets',
            'openTickets',
            'closedTickets',
            'pendingTickets',
            'recentTickets',
            'recentActivities',
            'ticketChart',
            'monthlyTickets',
            'currentMonthTickets',
            'resolvedPercentage',
            'latestUser'
        ));
    }
}