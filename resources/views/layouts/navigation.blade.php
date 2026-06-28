<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- NAV LINKS -->
                <div class="hidden space-x-8 sm:ml-10 sm:flex">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    {{-- USERS (ONLY ADMIN) --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                            Users
                        </x-nav-link>
                    @endif

                    {{-- TICKETS (ALL LOGGED IN USERS) --}}
                    <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                        Tickets
                    </x-nav-link>

                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        {{-- LOGOUT (FIXED POST METHOD) --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>

                    </x-slot>
                </x-dropdown>

            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="p-2">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                Tickets
            </x-responsive-nav-link>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                    Users
                </x-responsive-nav-link>
            @endif

        </div>

        <!-- MOBILE USER -->
        <div class="pt-4 pb-1 border-t">

            <div class="px-4">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                {{-- LOGOUT FIX --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>

            </div>
        </div>

    </div>

</nav>