<aside class="w-64 min-h-screen bg-slate-900 text-white flex flex-col">

    <!-- Logo -->
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-2xl font-bold">
            PTMS
        </h1>

        <p class="text-slate-400 text-sm">
            Admin Panel
        </p>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 mt-6">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800 border-l-4 border-blue-500' : '' }}">
            📊 Dashboard
        </a>

        <a href="{{ route('users.index') }}"
           class="block px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('users.*') ? 'bg-slate-800 border-l-4 border-blue-500' : '' }}">
            👥 Users
        </a>

        <a href="{{ route('tickets.index') }}"
           class="block px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('tickets.*') ? 'bg-slate-800 border-l-4 border-blue-500' : '' }}">
            🎫 Tickets
        </a>

        <a href="{{ route('reports.index') }}"
            class="block px-6 py-3 hover:bg-slate-800 {{ request()->routeIs('reports.*') ? 'bg-slate-800 border-l-4 border-blue-500' : '' }}">
            📈 Reports
        </a>

        <a href="{{ route('activity.index') }}"
            class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-100 transition">

            📜 <span class="ml-3">Activity Log</span>

        </a>

    </nav>

    <!-- Bottom User Section -->
    <div class="border-t border-slate-700 p-5">

        <p class="font-semibold">
            {{ auth()->user()->name }}
        </p>

        <p class="text-sm text-slate-400 mb-4">
            Administrator
        </p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg">
                Logout
            </button>
        </form>

    </div>

</aside>