<nav 
    x-data="{ scrolled: false, mobileMenuOpen: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
    :class="{ 'glass-dark text-white border-b border-gray-800/50 py-3 shadow-lg': scrolled, 'bg-transparent text-white py-5': !scrolled }"
    class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Kasiinfo Logo" class="h-8 md:h-10">
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="https://kasiinfo.id" target="_blank" class="text-sm font-bold text-white hover:text-gold transition-colors duration-200 flex items-center">
                    <i data-lucide="globe" class="w-4 h-4 mr-1"></i> Portal Utama
                </a>
                <a href="{{ url('/about') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">Tentang</a>
                <a href="{{ url('/guidebook') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">Panduan</a>
                <a href="{{ url('/timeline') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">Jadwal</a>
                <a href="{{ url('/prizes') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">Hadiah</a>
                <a href="{{ url('/categories') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">Kategori</a>
                <a href="{{ url('/faq') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200">FAQ</a>
                <a href="{{ route('track.index') }}" class="text-sm font-medium hover:text-gold transition-colors duration-200 flex items-center bg-gray-800/50 px-3 py-1.5 rounded-full border border-gray-700/50">
                    <i data-lucide="search" class="w-3.5 h-3.5 mr-1.5 text-gold"></i> Cek Status
                </a>
                
                @auth
                    @if(auth()->user()->hasRole('Judge'))
                        <a href="{{ route('judge.dashboard') }}" class="bg-gray-800 text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-gray-700 transition-colors duration-200 border border-gray-700">Dashboard Juri</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-800 text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-gray-700 transition-colors duration-200 border border-gray-700">Dashboard Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium hover:text-red-500 text-gray-400 transition-colors duration-200 ml-4">Logout</button>
                    </form>
                @else
                    <a href="{{ url('/register') }}" class="bg-gold text-dark px-6 py-2 rounded-full font-semibold text-sm hover:bg-yellow-500 transition-colors duration-200 shadow-[0_0_15px_rgba(212,175,55,0.4)]">
                        Daftar Sekarang
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-gold focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                    <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.away="mobileMenuOpen = false"
        class="md:hidden glass-dark border-t border-gray-800/50 absolute top-full left-0 w-full"
        x-cloak
    >
        <div class="px-4 pt-2 pb-6 space-y-1 text-center flex flex-col">
            <a href="https://kasiinfo.id" target="_blank" class="block px-3 py-3 text-base font-bold text-white hover:text-gold hover:bg-white/5 rounded-md flex items-center justify-center">
                <i data-lucide="globe" class="w-5 h-5 mr-2"></i> Portal Utama
            </a>
            <a href="{{ url('/about') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">Tentang</a>
            <a href="{{ url('/guidebook') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">Panduan</a>
            <a href="{{ url('/timeline') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">Jadwal</a>
            <a href="{{ url('/prizes') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">Hadiah</a>
            <a href="{{ url('/categories') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">Kategori</a>
            <a href="{{ url('/faq') }}" class="block px-3 py-3 text-base font-medium text-white hover:text-gold hover:bg-white/5 rounded-md">FAQ</a>
            <a href="{{ route('track.index') }}" class="block px-3 py-3 text-base font-bold text-gold hover:bg-white/5 rounded-md flex items-center justify-center bg-gray-800/30 mt-2">
                <i data-lucide="search" class="w-4 h-4 mr-2"></i> Cek Status Karya
            </a>
            
            @auth
                @if(auth()->user()->hasRole('Judge'))
                    <a href="{{ route('judge.dashboard') }}" class="block px-3 py-3 mt-4 text-base font-bold bg-gray-800 border border-gray-700 text-white rounded-md">Dashboard Juri</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-3 mt-4 text-base font-bold bg-gray-800 border border-gray-700 text-white rounded-md">Dashboard Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-3 mt-2 text-base font-medium text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-md">Logout</button>
                </form>
            @else
                <a href="{{ url('/register') }}" class="block px-3 py-3 mt-4 text-base font-bold bg-gold text-dark rounded-md">Daftar Sekarang</a>
            @endauth
        </div>
    </div>
</nav>
