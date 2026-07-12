<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Judging System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark text-white font-sans antialiased h-screen overflow-hidden flex flex-col">

    <!-- Top Navbar -->
    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex justify-between items-center z-50 relative" x-data="{ mobileMenuOpen: false }">
        <div class="flex justify-between items-center w-full md:w-auto">
            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="font-heading text-2xl tracking-widest text-white">
                    KASIINFO<span class="text-gold">.</span>
                </a>
            @hasanyrole('Admin|Admin Verifikasi')
            <div class="hidden md:flex space-x-4 border-l border-gray-700 pl-6">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-gold' : 'text-gray-400' }}">Dashboard</a>
                <a href="{{ route('admin.submissions.index') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.submissions.*') ? 'text-gold' : 'text-gray-400' }}">Verification Queue</a>
                <a href="{{ route('admin.results') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.results') ? 'text-gold' : 'text-gray-400' }}">Results</a>
                @hasrole('Admin')
                <a href="{{ route('admin.criteria.index') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.criteria.*') ? 'text-gold' : 'text-gray-400' }}">Scoring Criteria</a>
                <a href="{{ route('admin.users.index') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.users.*') ? 'text-gold' : 'text-gray-400' }}">Users</a>
                @endhasrole
            </div>
            @endhasanyrole
            @hasrole('Judge')
            <div class="hidden md:flex space-x-4 border-l border-gray-700 pl-6">
                <a href="{{ route('judge.dashboard') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('judge.dashboard') ? 'text-gold' : 'text-gray-400' }}">Dashboard</a>
                <a href="{{ route('judge.my_scores') }}" class="text-sm font-medium hover:text-gold transition-colors {{ request()->routeIs('judge.my_scores') ? 'text-gold' : 'text-gray-400' }}">My Scores</a>
            </div>
            @endhasrole
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-400 hover:text-white focus:outline-none">
                <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak style="display: none;"></i>
            </button>
        </div>
        
        <!-- Desktop Right Menu -->
        <div class="hidden md:flex items-center space-x-4">
            <span class="text-sm text-gray-400">Logged in as <span class="text-white font-bold">{{ Auth::user()->name }}</span></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-kasi-red transition-colors flex items-center">
                    <i data-lucide="log-out" class="w-4 h-4 mr-1"></i> Logout
                </button>
            </form>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="mobileMenuOpen" style="display: none;" @click.away="mobileMenuOpen = false" x-transition class="absolute top-full left-0 right-0 bg-gray-900 border-b border-gray-800 md:hidden flex flex-col px-6 py-4 space-y-4 shadow-xl z-50">
            @hasanyrole('Admin|Admin Verifikasi')
                <a href="{{ route('admin.dashboard') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.dashboard') ? 'text-gold' : 'text-gray-400' }}">Dashboard</a>
                <a href="{{ route('admin.submissions.index') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.submissions.*') ? 'text-gold' : 'text-gray-400' }}">Verification Queue</a>
                <a href="{{ route('admin.results') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.results') ? 'text-gold' : 'text-gray-400' }}">Results</a>
                @hasrole('Admin')
                <a href="{{ route('admin.criteria.index') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.criteria.*') ? 'text-gold' : 'text-gray-400' }}">Scoring Criteria</a>
                <a href="{{ route('admin.users.index') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('admin.users.*') ? 'text-gold' : 'text-gray-400' }}">Users</a>
                @endhasrole
            @endhasanyrole
            
            @hasrole('Judge')
                <a href="{{ route('judge.dashboard') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('judge.dashboard') ? 'text-gold' : 'text-gray-400' }}">Dashboard</a>
                <a href="{{ route('judge.my_scores') }}" class="text-base font-medium hover:text-gold transition-colors {{ request()->routeIs('judge.my_scores') ? 'text-gold' : 'text-gray-400' }}">My Scores</a>
            @endhasrole

            <div class="border-t border-gray-800 pt-4 mt-2">
                <span class="block text-sm text-gray-400 mb-3">Logged in as <span class="text-white font-bold">{{ Auth::user()->name }}</span></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-base text-gray-400 hover:text-kasi-red transition-colors flex items-center">
                        <i data-lucide="log-out" class="w-5 h-5 mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow overflow-auto relative">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
