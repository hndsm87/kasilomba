<x-layouts.admin title="My Scores | Judge Dashboard">
    <div class="p-4 md:p-8 max-w-7xl mx-auto flex flex-col md:h-full min-h-0" x-data="{ openLightbox: false, activeImage: '' }" @keydown.escape.window="openLightbox = false">
        
        <div class="mb-8" data-aos="fade-down">
            <h1 class="text-3xl font-heading text-white tracking-widest mb-2">MY SCORES</h1>
            <p class="text-gray-400">Review and edit your previous evaluations.</p>
        </div>

        <!-- Filters & Search -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6 flex justify-between items-center shadow-lg flex-col md:flex-row space-y-4 md:space-y-0">
            <div class="flex-shrink-0 w-full md:w-auto">
                <form action="{{ route('judge.my_scores') }}" method="GET" class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3" id="filterForm">
                    
                    <select name="category" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold w-full md:w-auto">
                        <option value="">All Categories</option>
                        <option value="smartphone" {{ request('category') === 'smartphone' ? 'selected' : '' }}>Smartphone</option>
                        <option value="dslr" {{ request('category') === 'dslr' ? 'selected' : '' }}>DSLR</option>
                    </select>

                    <input type="date" name="date" value="{{ request('date') }}" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold w-full md:w-auto" title="Filter by submission date">
                    
                    <select name="per_page" onchange="document.getElementById('filterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2 focus:ring-gold focus:border-gold w-full md:w-auto">
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 per page</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                    </select>

                    <div class="relative flex-grow md:w-64">
                        <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title..." class="w-full pl-9 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-xl text-sm text-white focus:ring-gold focus:border-gold placeholder-gray-500 transition-colors">
                    </div>
                    <!-- Submit button for text search, hidden since enter key works -->
                    <button type="submit" class="hidden">Search</button>
                </form>
            </div>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl md:flex-grow overflow-hidden shadow-2xl flex flex-col" data-aos="fade-up">
            <div class="overflow-x-auto overflow-y-visible md:overflow-y-auto">
                <table class="w-full text-left text-sm text-gray-400 border-collapse">
                    <thead class="text-xs text-gray-300 uppercase bg-gray-800 border-b border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">Photo</th>
                            <th scope="col" class="px-6 py-4 font-medium">Title & Category</th>
                            <th scope="col" class="px-6 py-4 text-center font-medium">Score</th>
                            <th scope="col" class="px-6 py-4 text-center font-medium">Updated At</th>
                            <th scope="col" class="px-6 py-4 text-center font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800/50">
                        @forelse($photos as $photo)
                            @php
                                $photoScores = $photo->scores;
                                $totalScore = 0;
                                foreach($photoScores as $score) {
                                    $totalScore += $score->score;
                                }
                            @endphp
                            <tr class="bg-gray-900 hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <button type="button" @click="activeImage = '{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}'; openLightbox = true" class="w-16 h-16 rounded-xl overflow-hidden border border-gray-700 relative group focus:outline-none focus:ring-2 focus:ring-gold block">
                                        <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Thumbnail" class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                                        </div>
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white mb-1">{{ $photo->title }}</div>
                                    <span class="px-2 py-1 bg-gray-800 border border-gray-700 text-gray-300 rounded text-[10px] uppercase tracking-wider font-bold">
                                        {{ $photo->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-lg font-bold text-gold">
                                    {{ number_format($totalScore, 1) }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500 text-xs">
                                    {{ $photoScores->isNotEmpty() ? $photoScores->first()->updated_at->diffForHumans() : '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('judge.photo', $photo->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-blue-500 hover:text-white text-blue-400 text-xs font-bold rounded-lg border border-gray-700 transition-colors">
                                        <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i data-lucide="folder-open" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                                    <p class="text-lg font-medium">No evaluated photos found.</p>
                                    <p class="text-sm mt-1">Try adjusting your filters or search query.</p>
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

        <!-- Lightbox Modal -->
        <div x-show="openLightbox" class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm" style="display: none;" x-transition.opacity>
            <button @click="openLightbox = false" class="absolute top-6 right-6 p-3 bg-gray-900/50 hover:bg-gold text-white hover:text-dark rounded-full transition-colors z-50">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <img :src="activeImage" referrerpolicy="no-referrer" alt="Thumbnail Preview" class="max-w-[400px] w-full object-contain shadow-2xl rounded-lg border border-gray-800" @click.away="openLightbox = false">
        </div>

    </div>
</x-layouts.admin>
