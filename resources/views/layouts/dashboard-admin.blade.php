<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PPDB Salafiyah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">
    <!-- Sidebar Admin -->
    <div class="fixed inset-y-0 left-0 w-64 bg-blue-800 text-white shadow-lg">
        <div class="p-4 border-b border-blue-700">
            <h1 class="text-xl font-bold">PPDB Salafiyah</h1>
            <p class="text-sm text-blue-200">Admin Dashboard</p>
        </div>
        <nav class="mt-4">
            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
            </x-nav-link>
            <x-nav-link href="{{ route('admin.santri') }}" :active="request()->routeIs('admin.santri')">
                <i class="fas fa-users mr-3"></i> Data Santri
            </x-nav-link>
            <x-nav-link href="{{ route('admin.berkas') }}" :active="request()->routeIs('admin.berkas')">
                <i class="fas fa-file-alt mr-3"></i> Berkas Santri
            </x-nav-link>
            <x-nav-link href="{{ route('admin.pembayaran') }}" :active="request()->routeIs('admin.pembayaran')">
                <i class="fas fa-money-bill-wave mr-3"></i> Pembayaran
            </x-nav-link>
            <x-nav-link href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                <i class="fas fa-cog mr-3"></i> Pengaturan
            </x-nav-link>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 min-h-screen">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm">
            <div class="flex justify-between items-center px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">@yield('title')</h2>
                <div class="flex items-center space-x-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </x-slot>
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            <i class="fas fa-user mr-2"></i> Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </x-dropdown-link>
                        </form>
                    </x-dropdown>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>