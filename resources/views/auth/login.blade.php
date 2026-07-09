<x-layouts.app title="Login | Judging System">
    <div class="min-h-screen bg-dark flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-gold rounded-full filter blur-[150px] opacity-20"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 bg-kasi-red rounded-full filter blur-[150px] opacity-20"></div>
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10" data-aos="fade-down">
            <h2 class="mt-6 text-center text-4xl font-heading font-extrabold text-white tracking-widest">
                JUDGING SYSTEM
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Sign in to your account
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10" data-aos="fade-up" data-aos-delay="100">
            <div class="glass-dark py-8 px-4 shadow-2xl sm:rounded-2xl sm:px-10 border border-gray-800/60">
                <form class="space-y-6" action="{{ url('/login') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            Email address
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="h-5 w-5 text-gray-500"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full pl-10 px-3 py-3 border border-gray-700 rounded-xl bg-gray-900/50 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent transition-all sm:text-sm" placeholder="judge@example.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">
                            Password
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="h-5 w-5 text-gray-500"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full pl-10 px-3 py-3 border border-gray-700 rounded-xl bg-gray-900/50 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent transition-all sm:text-sm" placeholder="••••••••">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-dark bg-gold hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-dark focus:ring-gold transition-all">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
