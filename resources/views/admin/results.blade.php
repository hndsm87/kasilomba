<x-layouts.admin title="Final Results | Admin Dashboard">
    <div class="p-8 max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-widest">FINAL RESULTS</h1>
                <p class="text-gray-400 mt-1">Aggregated scores from all judges, sorted by highest ranking.</p>
            </div>
            
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors flex items-center">
                <i data-lucide="download" class="w-4 h-4 mr-2"></i> Export Excel
            </button>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="text-xs text-gray-300 uppercase bg-gray-800 border-b border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">Rank</th>
                            <th scope="col" class="px-6 py-4">Photo</th>
                            <th scope="col" class="px-6 py-4">Title</th>
                            <th scope="col" class="px-6 py-4 text-center">Category</th>
                            <th scope="col" class="px-6 py-4 text-center">Final Score</th>
                            <th scope="col" class="px-6 py-4 text-center">Judges</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($photos as $index => $photo)
                            <tr class="bg-gray-900 border-b border-gray-800 hover:bg-gray-800/50 transition-colors {{ $index < 3 ? 'bg-gold/5' : '' }}">
                                <td class="px-6 py-4 text-center">
                                    @if($index == 0)
                                        <i data-lucide="award" class="w-8 h-8 text-yellow-400 mx-auto"></i>
                                    @elseif($index == 1)
                                        <i data-lucide="award" class="w-8 h-8 text-gray-400 mx-auto"></i>
                                    @elseif($index == 2)
                                        <i data-lucide="award" class="w-8 h-8 text-amber-600 mx-auto"></i>
                                    @else
                                        <span class="text-xl font-bold text-gray-500">#{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-gray-700 relative group cursor-pointer">
                                        <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Thumbnail" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                            <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-white">
                                    {{ $photo->title }}
                                </td>
                                <td class="px-6 py-4 text-center uppercase tracking-wider text-xs font-bold text-gray-300">
                                    {{ $photo->category }}
                                </td>
                                <td class="px-6 py-4 text-center text-xl font-bold {{ $index < 3 ? 'text-gold' : 'text-white' }}">
                                    {{ number_format($photo->final_score, 2) }}
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500">
                                    {{ $photo->scores->pluck('judge_id')->unique()->count() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.admin>
