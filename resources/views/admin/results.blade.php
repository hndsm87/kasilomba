<x-layouts.admin title="Final Results | Admin Dashboard">
    <div class="p-8 max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-widest">FINAL RESULTS</h1>
                <p class="text-gray-400 mt-1">Aggregated scores from all judges, sorted by highest ranking.</p>
            </div>
            
            <a href="{{ route('admin.results.export', ['category' => $category]) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors flex items-center">
                <i data-lucide="download" class="w-4 h-4 mr-2"></i> Export Excel
            </a>
        </div>

        <!-- Tabs -->
        <div class="flex mb-6 space-x-2">
            <a href="{{ route('admin.results', ['category' => 'smartphone']) }}" class="px-6 py-2 rounded-lg text-sm font-medium transition-colors {{ $category === 'smartphone' ? 'bg-gold text-dark font-bold' : 'bg-gray-900 text-gray-400 hover:text-white border border-gray-800' }}">
                Smartphone Category
            </a>
            <a href="{{ route('admin.results', ['category' => 'dslr']) }}" class="px-6 py-2 rounded-lg text-sm font-medium transition-colors {{ $category === 'dslr' ? 'bg-gold text-dark font-bold' : 'bg-gray-900 text-gray-400 hover:text-white border border-gray-800' }}">
                DSLR / Mirrorless
            </a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl flex flex-col" data-aos="fade-up">
            <div class="overflow-x-auto flex-grow">
                <table class="w-full text-left text-sm text-gray-400 border-collapse">
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
                    <tbody class="divide-y divide-gray-800/50">
                        @forelse($photos as $index => $photo)
                            @php
                                $rank = $photos->firstItem() + $index;
                            @endphp
                            <tr class="bg-gray-900 hover:bg-gray-800/50 transition-colors {{ $rank <= 3 ? 'bg-gold/5' : '' }}">
                                <td class="px-6 py-4 text-center">
                                    @if($rank == 1)
                                        <i data-lucide="award" class="w-8 h-8 text-yellow-400 mx-auto" title="1st Place"></i>
                                    @elseif($rank == 2)
                                        <i data-lucide="award" class="w-8 h-8 text-gray-400 mx-auto" title="2nd Place"></i>
                                    @elseif($rank == 3)
                                        <i data-lucide="award" class="w-8 h-8 text-amber-600 mx-auto" title="3rd Place"></i>
                                    @else
                                        <span class="text-xl font-bold text-gray-500">#{{ $rank }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.submissions.show', array_merge(['photo' => $photo->id, 'from' => 'results'], request()->query())) }}" class="block w-16 h-16 rounded-lg overflow-hidden border border-gray-700 relative group hover:border-gold transition-all duration-300">
                                        <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Thumbnail" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </a>
                                </td>
                                <td class="px-6 py-4 font-bold text-white">
                                    <a href="{{ route('admin.submissions.show', array_merge(['photo' => $photo->id, 'from' => 'results'], request()->query())) }}" class="hover:text-gold transition-colors">
                                        {{ $photo->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-center uppercase tracking-wider text-[10px] font-bold text-gray-400">
                                    <span class="px-2 py-1 bg-gray-800 border border-gray-700 rounded">{{ $photo->category }}</span>
                                </td>
                                <td class="px-6 py-4 text-center text-xl font-bold {{ $rank <= 3 ? 'text-gold' : 'text-white' }}">
                                    {{ number_format($photo->final_score, 2) }}
                                    @php
                                        $temaScore = $photo->scores->where('criteria_id', 1)->avg('score') ?? 0;
                                    @endphp
                                    <div class="text-[10px] text-gray-500 font-normal mt-0.5" title="Kesesuaian Tema & Narasi: {{ number_format($temaScore, 1) }} | Waktu Upload: {{ $photo->created_at->format('d/m/y H:i:s') }}">
                                        Tema: {{ number_format($temaScore, 1) }} • {{ $photo->created_at->format('d/m H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500">
                                    {{ $photo->scores->pluck('judge_id')->unique()->count() }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <i data-lucide="award" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                                    <p class="text-lg font-medium">No results available yet.</p>
                                    <p class="text-sm mt-1">Photos must be judged to appear here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($photos->hasPages())
            <div class="p-4 border-t border-gray-800 bg-gray-900/50">
                {{ $photos->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

    </div>
</x-layouts.admin>
