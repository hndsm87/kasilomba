<x-layouts.admin title="My Scores | Judge Dashboard">
    <div class="p-8 max-w-7xl mx-auto">
        
        <div class="mb-8" data-aos="fade-down">
            <h1 class="text-3xl font-heading text-white tracking-widest mb-2">MY SCORES</h1>
            <p class="text-gray-400">Review and edit your previous evaluations.</p>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="text-xs text-gray-300 uppercase bg-gray-800 border-b border-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4">Photo</th>
                            <th scope="col" class="px-6 py-4">Title</th>
                            <th scope="col" class="px-6 py-4 text-center">Score</th>
                            <th scope="col" class="px-6 py-4 text-center">Status</th>
                            <th scope="col" class="px-6 py-4 text-center">Updated At</th>
                            <th scope="col" class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($scores as $photoId => $photoScores)
                            @php
                                $photo = $photoScores->first()->photo;
                                $totalScore = 0;
                                foreach($photoScores as $score) {
                                    $totalScore += $score->score * ($score->criteria->weight / 100);
                                }
                            @endphp
                            <tr class="bg-gray-900 border-b border-gray-800 hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" alt="Thumbnail" class="w-16 h-16 object-cover rounded-lg border border-gray-700">
                                </td>
                                <td class="px-6 py-4 font-bold text-white">
                                    {{ $photo->title }}
                                </td>
                                <td class="px-6 py-4 text-center text-lg font-bold text-gold">
                                    {{ number_format($totalScore, 1) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 bg-green-500/10 text-green-500 rounded text-xs border border-green-500/20">Evaluated</span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-500 text-xs">
                                    {{ $photoScores->first()->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('judge.photo', $photo->id) }}" class="text-blue-500 hover:text-blue-400 transition-colors flex items-center justify-center font-bold">
                                        <i data-lucide="edit" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <i data-lucide="folder-open" class="w-12 h-12 mx-auto mb-3 opacity-50"></i>
                                    You haven't evaluated any photos yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.admin>
