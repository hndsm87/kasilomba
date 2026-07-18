<x-layouts.admin title="Judging | {{ $photo->title }}">
    
    <!-- Keyboard Navigation & Logic via Alpine.js -->
    <div x-data="judgingSystem()" 
         @keydown.window="handleKeydown($event)"
         class="flex flex-col lg:flex-row h-full w-full absolute inset-0 pt-[73px]"> <!-- Offset for Navbar -->
         
        <!-- Left: Photo Viewer (70%) -->
        <div class="w-full lg:w-[70%] h-[50vh] lg:h-full bg-black relative flex flex-col group">
            
            <!-- Top Bar Over Image -->
            <div class="absolute top-0 inset-x-0 p-6 bg-gradient-to-b from-black/80 to-transparent z-10 flex justify-between items-start opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div>
                    <span class="px-3 py-1 bg-gold text-dark text-xs font-bold uppercase tracking-widest rounded-full mb-2 inline-block">
                        {{ ucfirst($photo->category) }}
                    </span>
                    <h2 class="text-2xl font-bold text-white shadow-sm">{{ $photo->title }}</h2>
                    <p class="text-gray-300 text-sm flex items-center mt-1 flex-wrap gap-y-2">
                        <i data-lucide="map-pin" class="w-4 h-4 mr-1"></i> {{ $photo->location ?? 'Unknown Location' }} 
                        <span class="mx-2 hidden md:inline">•</span> 
                        <i data-lucide="calendar" class="w-4 h-4 mr-1"></i> {{ $photo->taken_at ? $photo->taken_at->format('d M Y') : 'Unknown Date' }}
                        @if($photo->device_used)
                            <span class="mx-2 hidden md:inline">•</span> 
                            <i data-lucide="camera" class="w-4 h-4 mr-1"></i> {{ $photo->device_used }}
                        @endif
                    </p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ $photo->original_url ?? $photo->google_drive_link }}" target="_blank" class="p-2 bg-black/50 hover:bg-gold text-white hover:text-dark rounded-full transition-colors backdrop-blur-md" title="Open Original File">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                    </a>
                    <button @click="toggleFullscreen()" class="p-2 bg-black/50 hover:bg-gold text-white hover:text-dark rounded-full transition-colors backdrop-blur-md" title="Fullscreen (F)">
                        <i data-lucide="maximize" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- The Image -->
            <div class="flex-grow flex items-center justify-center p-4 overflow-hidden" x-ref="photoContainer">
                <img src="{{ $photo->medium_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="{{ $photo->title }}" class="max-h-full max-w-full object-contain transition-transform duration-300" :class="{'scale-150 cursor-zoom-out': isZoomed, 'cursor-zoom-in': !isZoomed}" @click="isZoomed = !isZoomed">
            </div>
            
            <!-- Bottom Bar Over Image (Story) -->
            <div class="absolute bottom-0 inset-x-0 p-6 bg-gradient-to-t from-black/90 to-transparent z-10">
                <p class="text-gray-300 text-sm max-w-3xl leading-relaxed italic border-l-2 border-gold pl-4">
                    "{{ $photo->story }}"
                </p>
            </div>
            
            <!-- Fullscreen Overlay -->
            <div x-show="isFullscreen" x-transition class="fixed inset-0 z-[100] bg-black flex items-center justify-center" style="display: none;">
                <button @click="toggleFullscreen()" class="absolute top-6 right-6 p-3 bg-black/50 hover:bg-gold text-white hover:text-dark rounded-full transition-colors backdrop-blur-md z-[110]">
                    <i data-lucide="minimize" class="w-6 h-6"></i>
                </button>
                <img src="{{ $photo->original_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="{{ $photo->title }}" class="max-h-screen max-w-screen object-contain">
            </div>

        </div>

        <!-- Right: Scoring Panel (30%) -->
        <div class="w-full lg:w-[30%] h-[50vh] lg:h-full bg-gray-900 border-l border-gray-800 overflow-y-auto custom-scrollbar flex flex-col relative">
            
            <form id="scoringForm" action="{{ route('judge.store_score', $photo->id) }}" method="POST" class="p-6 flex-grow flex flex-col">
                @csrf
                
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="font-heading text-xl tracking-wider text-white">EVALUATION</h3>
                    <div class="text-right">
                        <span class="text-xs text-gray-500 uppercase tracking-widest block">Total Score</span>
                        <span class="text-3xl font-bold text-gold" x-text="totalScore.toFixed(1)">0.0</span>
                    </div>
                </div>

                <!-- Photo Meta Information (Always Visible) -->
                <div class="mb-6 bg-gray-800/40 p-4 rounded-xl border border-gray-700/50 space-y-3">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-2.5">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori Lomba</span>
                        <span class="px-2 py-0.5 bg-gold/10 text-gold text-xs font-bold uppercase tracking-wider rounded border border-gold/20">
                            {{ ucfirst($photo->category) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-start gap-4">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-0.5">Perangkat</span>
                        <div class="text-right text-xs text-gray-200 font-medium flex items-center justify-end">
                            <i data-lucide="camera" class="w-3.5 h-3.5 mr-1 text-gold"></i>
                            <span class="truncate max-w-[150px]" title="{{ $photo->device_used ?? 'Tidak Terdeteksi' }}">{{ $photo->device_used ?? 'Tidak Terdeteksi' }}</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu Foto</span>
                        <div class="text-right text-xs text-gray-300 font-medium flex items-center justify-end">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1 text-gold"></i>
                            <span>{{ $photo->taken_at ? $photo->taken_at->format('d M Y') : 'Unknown Date' }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 flex-grow">
                    @foreach($criterias as $criteria)
                    <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700/50">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-bold text-gray-200">{{ $criteria->name }}</label>
                            <span class="text-xs font-bold text-gray-500 bg-gray-800 px-2 py-1 rounded">Max {{ $criteria->weight }}</span>
                        </div>
                        <div class="flex items-center space-x-4 mb-3">
                            <input type="range" min="0" max="{{ $criteria->weight }}" step="1" 
                                   name="scores[{{ $criteria->id }}]" 
                                   x-model.number="scores[{{ $criteria->id }}]" 
                                   class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer accent-gold">
                            <input type="number" min="0" max="{{ $criteria->weight }}" 
                                   x-model.number="scores[{{ $criteria->id }}]" 
                                   class="w-16 bg-gray-900 border border-gray-700 rounded text-white text-center text-sm py-1 focus:ring-gold focus:border-gold">
                        </div>
                        @if($criteria->description)
                        <div class="mt-2 text-[11px] text-gray-400 whitespace-pre-wrap leading-relaxed bg-gray-900/50 p-3 rounded-lg border border-gray-800">{{ $criteria->description }}</div>
                        @endif
                    </div>
                    @endforeach

                    <div class="mt-6">
                        @php
                            $firstScore = $existingScores->first();
                            $existingNote = $firstScore ? $firstScore->notes : '';
                        @endphp
                        <label class="text-sm font-bold text-gray-400 mb-2 block">Judge Notes (Optional)</label>
                        <textarea name="notes" rows="3" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm text-gray-300 focus:ring-gold focus:border-gold" placeholder="Add specific feedback for this photo...">{{ $existingNote }}</textarea>
                    </div>

                    <!-- Custom Collections Section -->
                    <div class="mt-6 border-t border-gray-800 pt-6">
                        <label class="text-sm font-bold text-gray-400 mb-3 block flex items-center">
                            <i data-lucide="folder" class="w-4 h-4 mr-2 text-gold"></i> Kelompokkan Foto Ini (Koleksi)
                        </label>
                        
                        <!-- List of Collections -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            <template x-for="collection in collections" :key="collection.id">
                                <button type="button" 
                                        @click="toggleCollection(collection.id)"
                                        :class="isInCollection(collection.id) ? 'bg-gold/20 text-gold border-gold' : 'bg-gray-800 text-gray-400 border-gray-700 hover:border-gray-600'"
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" x-show="isInCollection(collection.id)">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span x-text="collection.name"></span>
                                </button>
                            </template>
                            <template x-if="collections.length === 0">
                                <span class="text-xs text-gray-500 italic block py-1">Belum ada kelompok foto. Buat di bawah ini.</span>
                            </template>
                        </div>

                        <!-- Add New Collection Form -->
                        <div class="flex space-x-2">
                            <input type="text" 
                                   x-model="newCollectionName" 
                                   @keydown.enter.prevent="createNewCollection()"
                                   placeholder="Tambah kelompok baru..." 
                                   class="flex-grow bg-gray-900 border border-gray-700 rounded-lg px-3 py-2 text-xs text-white focus:ring-gold focus:border-gold">
                            <button type="button" 
                                    @click="createNewCollection()"
                                    class="bg-gray-800 hover:bg-gray-700 border border-gray-700 hover:border-gray-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition-all">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bottom Actions -->
                <div class="mt-8 space-y-3 pt-6 border-t border-gray-800 sticky bottom-0 bg-gray-900 z-20">
                    <button type="submit" class="w-full py-4 bg-gold hover:bg-yellow-500 text-dark font-bold rounded-xl shadow-lg transition-colors flex justify-center items-center">
                        <i data-lucide="save" class="w-5 h-5 mr-2"></i> Save & Next (S)
                    </button>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('judge.next', ['skip_id' => $photo->id]) }}" class="w-1/2 py-3 bg-gray-800 hover:bg-gray-700 text-white font-medium rounded-xl border border-gray-700 transition-colors text-center text-sm">
                            Skip
                        </a>
                        <button type="button" @click="showReportDialog = true" class="w-1/2 py-3 bg-gray-800 hover:bg-kasi-red/20 hover:text-kasi-red text-gray-400 hover:border-kasi-red/50 font-medium rounded-xl border border-gray-700 transition-colors flex justify-center items-center text-sm">
                            <i data-lucide="flag" class="w-4 h-4 mr-2"></i> Report (R)
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Report Dialog -->
        <div x-show="showReportDialog" x-transition class="fixed inset-0 z-[200] bg-black/80 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl w-full max-w-md shadow-2xl" @click.away="showReportDialog = false">
                <div class="p-6 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-kasi-red mr-2"></i> Report Violation
                    </h3>
                    <button @click="showReportDialog = false" class="text-gray-400 hover:text-white">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <form action="{{ route('judge.report_photo', $photo->id) }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Reason</label>
                            <select name="reason" required class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-white focus:ring-kasi-red focus:border-kasi-red">
                                <option value="" disabled selected>Select a reason...</option>
                                <option value="AI Manipulation">Possible AI Manipulation</option>
                                <option value="Heavy Editing">Heavy Editing / Compositing</option>
                                <option value="Wrong Category">Wrong Category</option>
                                <option value="Not Original">Not Original Work</option>
                                <option value="Watermark">Contains Watermark/Identity</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Additional Notes</label>
                            <textarea name="notes" rows="3" class="w-full bg-gray-800 border border-gray-700 rounded-xl p-3 text-sm text-white focus:ring-kasi-red focus:border-kasi-red" placeholder="Explain the issue..."></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" @click="showReportDialog = false" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-kasi-red text-white font-bold rounded-lg hover:bg-red-700">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('judgingSystem', () => ({
                isZoomed: false,
                isFullscreen: false,
                showReportDialog: false,
                scores: {
                    @foreach($criterias as $criteria)
                        {{ $criteria->id }}: {{ isset($existingScores[$criteria->id]) ? $existingScores[$criteria->id]->score : 0 }},
                    @endforeach
                },
                weights: {
                    @foreach($criterias as $criteria)
                        {{ $criteria->id }}: {{ $criteria->weight }},
                    @endforeach
                },
                collections: @json($judgeCollections),
                activeCollectionIds: @json($activeCollectionIds),
                newCollectionName: '',

                isInCollection(id) {
                    return this.activeCollectionIds.includes(id);
                },

                toggleCollection(id) {
                    fetch('{{ route("judge.collections.toggle_photo", $photo->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ collection_id: id })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            if (data.status === 'added') {
                                this.activeCollectionIds.push(id);
                            } else {
                                this.activeCollectionIds = this.activeCollectionIds.filter(x => x !== id);
                            }
                        }
                    });
                },

                createNewCollection() {
                    if (!this.newCollectionName.trim()) return;
                    fetch('{{ route("judge.collections.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name: this.newCollectionName })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const newCol = data.collection;
                            if (!this.collections.some(x => x.id === newCol.id)) {
                                this.collections.push(newCol);
                            }
                            this.toggleCollection(newCol.id);
                            this.newCollectionName = '';
                        }
                    });
                },
                
                get totalScore() {
                    let total = 0;
                    for (const id in this.scores) {
                        const score = parseFloat(this.scores[id]) || 0;
                        total += score;
                    }
                    return total;
                },

                toggleFullscreen() {
                    this.isFullscreen = !this.isFullscreen;
                    if(this.isFullscreen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                    }
                },

                handleKeydown(e) {
                    // Don't trigger if user is typing in a textarea or input
                    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT') return;

                    switch(e.key.toLowerCase()) {
                        case 's':
                            e.preventDefault();
                            document.getElementById('scoringForm').submit();
                            break;
                        case 'r':
                            e.preventDefault();
                            this.showReportDialog = true;
                            break;
                        case 'f':
                            e.preventDefault();
                            this.toggleFullscreen();
                            break;
                        case 'escape':
                            if(this.isFullscreen) this.isFullscreen = false;
                            if(this.showReportDialog) this.showReportDialog = false;
                            break;
                    }
                }
            }));
        });
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #111827; 
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #374151; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #4B5563; 
        }
    </style>
    @endpush
</x-layouts.admin>
