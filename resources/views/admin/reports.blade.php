<x-layouts.admin title="Judge Reports">
    <div class="p-4 md:p-8 max-w-7xl mx-auto flex flex-col md:h-full min-h-0" x-data="{ openLightbox: false, activeImage: '' }" @keydown.escape.window="openLightbox = false">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-heading text-white tracking-wider">Judge Reports</h1>
                <p class="text-gray-400 mt-1">Review flagged photos and take action.</p>
            </div>
        </div>

        <!-- Filters & Search -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 mb-6 flex flex-col space-y-4 shadow-lg">
            
            <!-- Tabs -->
            <div class="flex flex-wrap gap-2">
                @foreach($stats as $tabStatus => $count)
                    <a href="{{ route('admin.reports', ['status' => $tabStatus]) }}" 
                       class="px-4 py-2 rounded-xl text-sm font-medium transition-colors whitespace-nowrap {{ $status === $tabStatus ? 'bg-kasi-red text-white' : 'bg-gray-800 text-gray-400 hover:text-white hover:bg-gray-700' }}">
                        {{ ucfirst($tabStatus) }}
                        <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold rounded-full {{ $status === $tabStatus ? 'bg-dark/20 text-white' : 'bg-gray-700 text-gray-300' }}">
                            {{ $count }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Table -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl md:flex-grow overflow-hidden shadow-lg flex flex-col">
            <div class="overflow-x-auto overflow-y-visible md:overflow-y-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800/50 border-b border-gray-800 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6 font-medium">Photo</th>
                            <th class="py-4 px-6 font-medium">Report Details</th>
                            <th class="py-4 px-6 font-medium">Participant</th>
                            <th class="py-4 px-6 font-medium">Date Reported</th>
                            <th class="py-4 px-6 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-800/50">
                        @forelse($reports as $report)
                        <tr class="hover:bg-gray-800/30 transition-colors group">
                            <td class="py-3 px-6">
                                <button type="button" @click="activeImage = '{{ $report->photo->thumbnail_url ?? $report->photo->google_drive_preview }}'; openLightbox = true" class="w-16 h-16 rounded-xl overflow-hidden border border-gray-700 relative group focus:outline-none focus:ring-2 focus:ring-kasi-red block">
                                    <img src="{{ $report->photo->thumbnail_url ?? $report->photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="Thumbnail" class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                                    </div>
                                </button>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-white flex items-center">
                                    <i data-lucide="alert-triangle" class="w-4 h-4 text-kasi-red mr-1.5"></i>
                                    {{ $report->reason }}
                                </div>
                                <div class="text-xs text-gray-400 mt-1 max-w-[250px] leading-relaxed">
                                    {{ $report->notes ?? 'No additional notes provided.' }}
                                </div>
                                <div class="text-[10px] text-gray-500 mt-2">Reported by: {{ $report->judge->name }}</div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-white">
                                    {{ $report->photo->participant_name ?? 'Unknown' }}
                                </div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $report->photo->title }}</div>
                            </td>
                            <td class="py-3 px-6 text-gray-400">
                                {{ $report->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 px-6 text-right">
                                @if($report->status === 'pending')
                                <div class="flex items-center justify-end space-x-2">
                                    <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="dismiss">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white text-xs font-bold rounded-lg border border-gray-700 transition-colors" onclick="return confirm('Dismiss this report? Photo will remain active.')">
                                            Dismiss
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="disqualify">
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-kasi-red/20 hover:bg-kasi-red text-red-400 hover:text-white border border-kasi-red/30 hover:border-kasi-red text-xs font-bold rounded-lg transition-colors" onclick="return confirm('Disqualify this photo? This cannot be easily undone.')">
                                            Disqualify
                                        </button>
                                    </form>
                                </div>
                                @else
                                <span class="px-3 py-1 bg-gray-800 border border-gray-700 {{ $report->status === 'resolved' ? 'text-red-400' : 'text-gray-400' }} rounded-lg text-xs font-bold uppercase tracking-wider">
                                    {{ $report->status }}
                                </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i data-lucide="shield-check" class="w-12 h-12 mb-3 text-gray-700"></i>
                                    <p class="text-lg font-medium">No reports found.</p>
                                    <p class="text-sm mt-1">Everything looks clear and safe.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($reports->hasPages())
            <div class="p-4 border-t border-gray-800 bg-gray-900/50">
                {{ $reports->links() }}
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
