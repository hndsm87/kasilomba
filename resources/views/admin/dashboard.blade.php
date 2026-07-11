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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-500/10 rounded-xl">
                        <i data-lucide="image" class="w-6 h-6 text-blue-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Total Submissions</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['total_photos']) }}</h3>
                <p class="text-sm text-gray-400">Total Photos Synced</p>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-purple-500/10 rounded-xl">
                        <i data-lucide="users" class="w-6 h-6 text-purple-500"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gray-800 text-gray-300 rounded-full">Unique</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1">{{ number_format($stats['unique_participants']) }}</h3>
                <p class="text-sm text-gray-400">Unique Participants</p>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 shadow-lg relative overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-gold/10 rounded-full blur-xl"></div>
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div class="p-3 bg-gold/10 rounded-xl">
                        <i data-lucide="zap" class="w-6 h-6 text-gold"></i>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-gold/20 text-gold rounded-full border border-gold/30">Today</span>
                </div>
                <h3 class="text-4xl font-bold text-white mb-1 relative z-10">+{{ number_format($stats['new_today']) }}</h3>
                <p class="text-sm text-gray-400 relative z-10">New Registrants Today</p>
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
                    @hasrole('Admin')
                    <a href="{{ route('admin.criteria.index') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="settings-2" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">Manage Criteria</span>
                    </a>
                    @endhasrole
                    <a href="{{ route('admin.results') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="award" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">View Final Results</span>
                    </a>
                    <a href="{{ route('admin.reports') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6 text-center transition-colors group">
                        <i data-lucide="shield-alert" class="w-8 h-8 text-gold mx-auto mb-3 group-hover:scale-110 transition-transform"></i>
                        <span class="block text-sm font-bold text-white">Review Reports</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- DANGER ZONE -->
        @hasrole('Admin')
        <div class="mt-8 bg-red-900/20 border border-red-900/50 rounded-2xl p-6 shadow-lg flex flex-col md:flex-row justify-between items-center" x-data="{ openResetModal: false }">
            <div>
                <h4 class="font-bold text-red-500 mb-1 flex items-center">
                    <i data-lucide="alert-triangle" class="w-5 h-5 mr-2"></i> Danger Zone
                </h4>
                <p class="text-gray-400 text-sm">Hapus seluruh data peserta, laporan, dan skor. Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <button @click="openResetModal = true" class="mt-4 md:mt-0 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-colors flex items-center shadow-lg">
                <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i> Reset Sistem
            </button>

            <!-- Reset Confirmation Modal -->
            <div x-show="openResetModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" x-transition>
                <div class="bg-gray-900 border border-red-500/30 rounded-2xl p-8 max-w-md w-full shadow-2xl relative" @click.away="openResetModal = false">
                    <button @click="openResetModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-white">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                    
                    <div class="w-16 h-16 bg-red-500/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/50">
                        <i data-lucide="alert-triangle" class="w-8 h-8 text-red-500"></i>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white text-center mb-2">Reset Seluruh Data?</h3>
                    <p class="text-gray-400 text-sm text-center mb-6 leading-relaxed">
                        Tindakan ini akan menghapus permanen <strong>semua foto, skor juri, dan laporan</strong> yang ada di database. Sistem akan kembali kosong seperti semula.
                    </p>

                    <form action="{{ route('admin.system.reset') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2 text-center">Ketik <span class="text-red-400 font-bold">HAPUS SEMUA DATA</span> untuk melanjutkan</label>
                            <input type="text" name="confirmation" required autocomplete="off" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl text-white text-center font-bold focus:ring-2 focus:ring-red-500 focus:border-red-500 uppercase">
                        </div>
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-xl transition-colors mt-2">
                            Ya, Hapus Semuanya
                        </button>
                        <button type="button" @click="openResetModal = false" class="w-full bg-transparent text-gray-400 hover:text-white font-medium py-2 px-4 transition-colors">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endhasrole
    </div>
</x-layouts.admin>
