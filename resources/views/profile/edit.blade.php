@extends('admin.layouts.app')

@section('content')

<div class="space-y-8">

    <!-- Page Heading -->
    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            My Profile
        </h1>

        <p class="text-gray-500 mt-1">
            Manage your account information and security.
        </p>

    </div>

    <!-- Profile Summary -->
    <div class="bg-white rounded-2xl shadow-md p-8">

        <div class="flex items-center gap-6">

            <!-- Avatar -->
            <div
                class="w-24 h-24 rounded-full bg-blue-600 text-white flex items-center justify-center text-4xl font-bold">

                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

            </div>

            <!-- Details -->
            <div class="flex-1">

                <h2 class="text-2xl font-bold text-gray-800">
                    {{ Auth::user()->name }}
                </h2>

                <p class="text-gray-500 mt-1">
                    {{ Auth::user()->email }}
                </p>

                <div class="flex gap-3 mt-4">

                    <span
                        class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">

                        {{ ucfirst(str_replace('_',' ',Auth::user()->role)) }}

                    </span>

                    <span
                        class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">

                        Active

                    </span>

                </div>

            </div>

            <!-- Member Since -->
            <div class="bg-gray-50 rounded-xl px-6 py-4 text-center shadow-sm border">

                <p class="text-gray-500 text-sm">
                    📅 Member Since
                </p>
            
                <p class="text-lg font-bold text-gray-800 mt-1">
                    {{ Auth::user()->created_at->format('d M Y') }}
                </p>
            
            </div>

        </div>

    </div>


    
    <!-- Forms -->
    @include('profile.partials.update-profile-information-form')

    @include('profile.partials.update-password-form')

</div>

@endsection