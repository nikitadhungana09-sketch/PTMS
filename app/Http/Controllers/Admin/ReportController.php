<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', [

            'totalUsers' => User::count(),

            'totalTickets' => Ticket::count(),

            'openTickets' => Ticket::where('status', 'open')->count(),

            'pendingTickets' => Ticket::where('status', 'pending')->count(),

            'closedTickets' => Ticket::where('status', 'closed')->count(),

        ]);
    }
}