<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - PPDB Salafiyah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <!-- Sidebar User -->
    <div class="fixed inset-y-0 left-0 w-56 bg-green-700 text-white shadow-lg">
        <div class="p-4 border-b border-green-600">
            <h1 class="text-lg font-bold">PPDB Salafiyah</h1>
            <p class="text-xs text-green-200">Santri Dashboard</p>
        </div>
        <nav class="mt-4">
            <x-nav-link href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')">
                <i class="fas fa-home mr-3"></i> Dashboard
            </x-nav-link>
            <x-nav-link href="{{ route('user.profile') }}" :active="request()->routeIs('user.profile')">
                <i class="fas fa-user mr-3"></i> Data Santri
            </x-nav-link>
            <x-nav-link href="{{ route('user.orangtua') }}" :active="request()->routeIs('user.orangtua')">
                <i class="fas fa-users mr-3"></i> Data Orang Tua
            </x-nav-link>
            <x-nav-link href="{{ route('user.berkas') }}" :active="request()->routeIs('user.berkas')">
                <i class="fas fa-file-upload mr-3"></i> Berkas Santri
            </x-nav-link>
            <x-nav-link href="{{ route('user.pembayaran') }}" :active="request()->routeIs('user.pembayaran')">
                <i class="fas fa-receipt mr-3"></i> Pembayaran
            </x-nav-link>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-56 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm">
            <div class="flex justify-between items-center px-6 py-3">
                <h2 class="text-md font-semibold text-gray-800">@yield('title')</h2>
                <div class="flex items-center space-x-4">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                    </div>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-sm text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-5">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>