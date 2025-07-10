<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Explorer - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-nav text-white flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Event Explorer</h2>
            </div>
            
            <nav class="mt-8">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Dashboard
                </a>
                
                <a href="{{ route('events.index') }}" class="nav-item {{ request()->routeIs('events.*') ? 'active' : '' }} flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Events
                </a>
                
                <a href="{{ route('event-requests.index') }}" class="nav-item {{ request()->routeIs('event-requests.*') ? 'active' : '' }} flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors">
                    <i class="fas fa-clock mr-3"></i>
                    Event Proposals
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>