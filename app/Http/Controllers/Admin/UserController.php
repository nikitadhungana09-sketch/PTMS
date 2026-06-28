<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index(): View
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show create user form.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role'  => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password123'),
            'role'     => $request->role,
        ]);

        // Activity Log
        activityLog(
            'User Created',
            'Created user: ' . $user->name
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,user',
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Activity Log
        activityLog(
            'User Updated',
            'Updated user: ' . $user->name
        );

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->getKey() == Auth::id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Activity Log (before deleting)
        activityLog(
            'User Deleted',
            'Deleted user: ' . $user->name
        );

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}