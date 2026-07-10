<x-layouts.admin title="Verification Queue">
    <div class="p-8 max-w-7xl mx-auto flex flex-col h-full">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-wider">Verification Queue</h1>
                <p class="text-gray-400 mt-1">Manage and verify incoming submissions before judging.</p>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6 flex justify-between items-center shadow-lg">
            
            <div class="flex space-x-2 overflow-x-auto custom-scrollbar pb-2 md:pb-0">
                @foreach($stats as $tabStatus => $count)
                    <a href="{{ route('admin.submissions.index', ['status' => $tabStatus]) }}" 
                       class="px-4 py-2 rounded-xl text-sm font-medium transition-colors whitespace-nowrap {{ $status === $tabStatus ? 'bg-gold text-dark' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700' }}">
                        {{ $tabStatus }}
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold rounded-full {{ $status === $tabStatus ? 'bg-dark/20 text-dark' : 'bg-gray-700 text-gray-300' }}">
                            {{ $count }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="flex-shrink-0 ml-4 w-full md:w-auto mt-4 md:mt-0">
                <form action="{{ route('admin.submissions.index') }}" method="GET" class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3" id="filterForm">
                    <input type="hidden" name="status" value="{{ $status }}">
                    
                    <select name="category" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold">
                        <option value="">All Categories</option>
                        <option value="smartphone" {{ request('category') === 'smartphone' ? 'selected' : '' }}>Smartphone</option>
                        <option value="dslr" {{ request('category') === 'dslr' ? 'selected' : '' }}>DSLR</option>
                    </select>

                    <input type="date" name="date" value="{{ request('date') }}" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold" title="Filter by submission date">
                    
                    <select name="per_page" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold">
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 per page</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                    </select>

                    <div class="relative flex-grow md:w-64">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, village..." class="w-full pl-9 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-xl text-sm text-white focus:ring-gold focus:border-gold placeholder-gray-500 transition-colors">
                    </div>
                    <!-- Submit button for text search, hidden since enter key works -->
                    <button type="submit" class="hidden">Search</button>
                </form>
            </div>

        </div>

        <!-- Table -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl flex-grow overflow-hidden shadow-lg flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800/50 border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-medium">Photo</th>
                            <th class="py-4 px-6 font-medium">Participant</th>
                            <th class="py-4 px-6 font-medium">Category</th>
                            <th class="py-4 px-6 font-medium">Village</th>
                            <th class="py-4 px-6 font-medium">Date</th>
                            <th class="py-4 px-6 font-medium">Health</th>
                            <th class="py-4 px-6 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-800/50">
                        @forelse($photos as $photo)
                        <tr class="hover:bg-gray-800/30 transition-colors group">
                            <td class="py-3 px-6">
                                <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-700 relative">
                                    <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Thumbnail" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-white flex items-center">
                                    {{ $photo->participant_name ?? 'Unknown' }}
                                    @if($photo->is_duplicate)
                                        <span class="ml-2 px-2 py-0.5 bg-red-500/20 border border-red-500/30 text-red-400 text-[10px] uppercase font-bold rounded-full inline-flex items-center" title="Multiple photos found with this WhatsApp/Instagram">
                                            <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i> Duplicate
                                        </span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500 mt-0.5 truncate max-w-[200px]">{{ $photo->title }}</div>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-1 bg-gray-800 border border-gray-700 text-gray-300 rounded text-xs uppercase tracking-wider font-bold">
                                    {{ $photo->category }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-gray-400">
                                {{ $photo->village ?? '-' }}
                            </td>
                            <td class="py-3 px-6 text-gray-400">
                                {{ $photo->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 px-6">
                                @php
                                    $health = $photo->health_score;
                                    $healthColor = $health >= 90 ? 'text-green-400' : ($health >= 70 ? 'text-yellow-400' : 'text-red-400');
                                @endphp
                                <div class="flex items-center space-x-2">
                                    <span class="font-bold {{ $healthColor }}">{{ $health }}%</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <a href="{{ route('admin.submissions.show', $photo->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gold hover:text-dark text-white text-xs font-bold rounded-lg border border-gray-700 transition-colors">
                                    Verify <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i data-lucide="inbox" class="w-12 h-12 mb-3 text-gray-700"></i>
                                    <p class="text-lg font-medium">No submissions found.</p>
                                    <p class="text-sm mt-1">Try adjusting your filters or search query.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($photos->hasPages())
            <div class="p-4 border-t border-gray-800 bg-gray-900/50">
                {{ $photos->links() }}
            </div>
            @endif
        </div>
    </div>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent; 
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #374151; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #4B5563; 
        }
    </style>
</x-layouts.admin>
