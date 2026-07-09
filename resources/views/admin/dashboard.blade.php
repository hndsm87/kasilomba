<x-layouts.admin title="Admin Dashboard">
    <div class="p-8 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-wider">System Overview</h1>
                <p class="text-gray-400 mt-1">Real-time judging statistics and management.</p>
            </div>
            
            <div class="flex space-x-4">
                <button class="bg-gray-800 border border-gray-700 hover:border-gold text-white px-4 py-2 rounded-lg text-sm transition-colors flex items-center">
                    <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i> Sync Google Sheets
                </button>
                <button class="bg-kasi-red text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-700 transition-colors flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Lock System
                </button>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-500/10 rounded-xl">
                        <i data-lucide="image" class="w-6 h-6 text-blue-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Total</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['total_photos']) }}</h3>
                <p class="text-sm text-gray-400">Total Photos Synced</p>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-green-500/10 rounded-xl">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Progress</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['judged']) }}</h3>
                <p class="text-sm text-gray-400">Photos Judged</p>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-yellow-500/10 rounded-xl">
                        <i data-lucide="clock" class="w-6 h-6 text-yellow-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Queue</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['pending']) }}</h3>
                <p class="text-sm text-gray-400">Pending Review</p>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-red-500/10 rounded-xl">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Action Required</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['reported']) }}</h3>
                <p class="text-sm text-gray-400">Flagged/Reported</p>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Category Breakdown -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg lg:col-span-1">
                <h4 class="font-heading text-xl text-white mb-6 tracking-wide">Category Breakdown</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-400">Smartphone</span>
                            <span class="text-white font-bold">{{ number_format($stats['smartphone']) }}</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-gold h-2 rounded-full" style="width: {{ $stats['total_photos'] > 0 ? ($stats['smartphone'] / $stats['total_photos']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-400">DSLR / Mirrorless</span>
                            <span class="text-white font-bold">{{ number_format($stats['dslr']) }}</span>
                        </div>
                        <div class="w-full bg-gray-800 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['total_photos'] > 0 ? ($stats['dslr'] / $stats['total_photos']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg lg:col-span-2 flex flex-col justify-center">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="settings-2" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">Manage Criteria</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="award" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">View Final Results</span>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="shield-alert" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">Review Reports</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
