<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets.
     */
    public function index(Request $request)
    {
        $query = Ticket::query();

        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        // Admin sees all tickets
        if ($user->role !== 'admin') {
            $query->where('created_by', $user->id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query
            ->with('user')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->count();
        $pendingTickets = Ticket::where('status', 'pending')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        return view('admin.tickets.index', compact(
            'tickets',
            'totalTickets',
            'openTickets',
            'pendingTickets',
            'closedTickets'
        ));
    }

    /**
     * Display a single ticket.
     */
    public function show($id)
    {
        $ticket = Ticket::with('user')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $ticket->created_by != Auth::id()) {
            abort(403);
        }

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.tickets.create');
    }

    /**
     * Store new ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:Low,Medium,High,Critical',
        ]);
    
        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'open',
            'created_by' => Auth::id(),
        ]);
    
        activityLog(
            'Ticket Created',
            'Created ' . $ticket->priority . ' priority ticket: ' . $ticket->title
        );
    
        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $ticket->created_by != Auth::id()) {
            abort(403);
        }

        return view('admin.tickets.edit', compact('ticket'));
    }

    /**
     * Update ticket.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $ticket->created_by != Auth::id()) {
            abort(403);
        }

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        activityLog(
            'Ticket Updated',
            'Updated ticket: ' . $ticket->title
        );

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket updated successfully.');
    }

    /**
     * Delete ticket.
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $ticket->created_by != Auth::id()) {
            abort(403);
        }

        activityLog(
            'Ticket Deleted',
            'Deleted ticket: ' . $ticket->title
        );

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket deleted successfully.');
    }
}