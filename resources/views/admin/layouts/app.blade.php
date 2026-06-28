<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PTMS Admin Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Navbar -->
        @include('admin.layouts.navbar')

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>