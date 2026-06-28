<header class="bg-white shadow px-8 py-5 flex justify-between items-center">

    <!-- Logo -->
    <div class="flex items-center gap-3">

        <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg">
    
            <span class="text-white text-xl font-bold">
                P
            </span>
    
        </div>
    
        <div>
    
            <h1 class="text-2xl font-bold text-gray-800 tracking-wide">
                PTMS
            </h1>
    
        </div>
    
    </div>

    <!-- Right Side -->
    <div class="flex items-center space-x-4">

        <!-- Notifications -->
        <div class="relative">

            <button id="notificationButton"
           class="relative flex items-center justify-center
           h-12 w-12
           rounded-xl
           border border-gray-200
           bg-white
           shadow-sm
           hover:shadow-md
           hover:bg-gray-50
           transition-all duration-200">

    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-6 h-6 text-gray-700"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor">

        <path stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 17h5l-1.405-1.405A2.032 2.032 0
               0118 14.158V11a6.002 6.002 0
               00-4-5.659V5a2 2 0
               10-4 0v.341C7.67
               6.165 6 8.388 6 11v3.159
               c0 .538-.214 1.055-.595
               1.436L4 17h5m6
               0v1a3 3 0
               11-6 0v-1m6 0H9"/>

    </svg>

                @if($notificationCount > 0)
                <span
                class="absolute
                -top-1
                -right-1
                flex
                h-5
                w-5
                items-center
                justify-center
                rounded-full
                bg-red-500
                text-[10px]
                font-bold
                text-white
                ring-2
                ring-white">
                {{ $notificationCount }}
                </span>
                @endif

            </button>

            <!-- Notification Dropdown -->
            <div id="notificationMenu"
                class="hidden absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-xl border z-50">
            
                <!-- Header -->
                <div class="flex items-center justify-between px-5 py-4 border-b bg-gray-50 rounded-t-xl">

                    <h3 class="font-bold text-gray-800 text-lg">
                        Notifications
                    </h3>
                
                    @if($notificationCount > 0)
                        <span class="text-xs bg-red-500 text-white px-2 py-1 rounded-full font-semibold">
                        {{ $notificationCount }}
                        </span>
                    @endif
                
                </div>
            
                <!-- Notification List -->
                <div class="divide-y max-h-96 overflow-y-auto">
            
                    @forelse($notifications as $notification)
            
                    <div class="flex items-start gap-3 px-4 py-4 hover:bg-gray-50 transition">

                        <!-- Icon -->
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    
                            @if(str_contains(strtolower($notification->action), 'ticket'))
                                🎫
                            @elseif(str_contains(strtolower($notification->action), 'user'))
                                👤
                            @elseif(str_contains(strtolower($notification->action), 'login'))
                                🔓
                            @elseif(str_contains(strtolower($notification->action), 'logout'))
                                🔒
                            @else
                                🔔
                            @endif
                    
                        </div>
                    
                        <!-- Content -->
                        <div class="flex-1">
                    
                            <div class="flex justify-between items-start">
                    
                                <h4 class="font-semibold text-gray-800">
                                    {{ $notification->action }}
                                </h4>
                    
                                <small class="text-xs text-gray-400 whitespace-nowrap">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                    
                            </div>
                    
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $notification->description }}
                            </p>
                    
                        </div>
                    
                    </div>
            
                    @empty
            
                    <div class="py-10 text-center">

                        <div class="text-5xl mb-3">
                            🔔
                        </div>
                    
                        <h4 class="font-semibold text-gray-700">
                            You're all caught up!
                        </h4>
                    
                        <p class="text-sm text-gray-500 mt-1">
                            No new notifications.
                        </p>
                    
                    </div>
            
                    @endforelse
            
                </div>
            
                <!-- Footer -->
                <div class="px-5 py-3 border-t bg-gray-50 rounded-b-xl">

                    <a href="{{ route('activity.index') }}"
                        class="flex items-center justify-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition">
                
                        View All Activity
                
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 5l7 7-7 7"/>
                
                        </svg>
                
                    </a>
                
                </div>
            
            </div>
            

        </div>

<!-- Profile -->
<div class="relative flex items-center">

    <button id="profileButton"
    class="flex items-center gap-3 h-12 px-3 rounded-xl hover:bg-gray-100 transition">

        <!-- Avatar -->
        <div
            class="w-11 h-11 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-lg shadow">

            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

        </div>

        <!-- User Info -->
        <div class="hidden md:block text-left">
            <p class="font-semibold text-gray-800 leading-tight">
                {{ Auth::user()->name }}
            </p>

            <p class="text-xs text-gray-500">
                {{ ucfirst(Auth::user()->role) }}
            </p>
        </div>

        <!-- Arrow -->
        <svg xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 text-gray-500"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 9l-7 7-7-7" />

        </svg>

    </button>

    <!-- Profile Dropdown -->
    <div id="profileMenu"
        class="hidden absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border z-50">

        <a href="{{ route('profile.edit') }}"
            class="block px-4 py-3 hover:bg-gray-50">
            👤 My Profile
        </a>

        <a href="#"
            class="block px-4 py-3 hover:bg-gray-50">
            ⚙ Settings
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full text-left px-4 py-3 hover:bg-red-50 text-red-600">
                🚪 Logout
            </button>
        </form>

    </div>

</div>


    </div>

</header>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // Notification
    const notificationButton = document.getElementById('notificationButton');
    const notificationMenu = document.getElementById('notificationMenu');

    notificationButton.addEventListener('click', function(e){

        e.stopPropagation();

        notificationMenu.classList.toggle('hidden');

        profileMenu.classList.add('hidden');

    });

    // Profile
    const profileButton = document.getElementById('profileButton');
    const profileMenu = document.getElementById('profileMenu');

    profileButton.addEventListener('click', function(e){

        e.stopPropagation();

        profileMenu.classList.toggle('hidden');

        notificationMenu.classList.add('hidden');

    });

    // Close when clicking outside
    document.addEventListener('click', function(){

        notificationMenu.classList.add('hidden');

        profileMenu.classList.add('hidden');

    });

    notificationMenu.addEventListener('click', function(e){

        e.stopPropagation();

    });

    profileMenu.addEventListener('click', function(e){

        e.stopPropagation();

    });

});

</script>