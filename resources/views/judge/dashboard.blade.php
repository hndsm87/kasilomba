<x-layouts.admin title="Judge Dashboard">
    <div class="p-8 max-w-7xl mx-auto flex flex-col min-h-[80vh]" 
         x-data="{ 
            selectedPhotos: [], 
            bulkCollectionId: '',
            bulkAssign(collectionId) {
                if (this.selectedPhotos.length === 0 || !collectionId) return;
                fetch('{{ route('judge.collections.bulk_assign') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        collection_id: collectionId,
                        photo_ids: this.selectedPhotos
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.selectedPhotos = [];
                        window.location.reload();
                    }
                });
            }
         }">
        
        <!-- Header -->
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between border-b border-gray-800 pb-8" data-aos="fade-down">
            <div>
                <div class="w-16 h-16 bg-gray-900 border border-gray-800 rounded-full flex items-center justify-center mb-6 shadow-xl">
                    <i data-lucide="camera" class="w-8 h-8 text-gold"></i>
                </div>
                <h1 class="text-4xl font-heading text-white tracking-widest mb-2">JUDGING PORTAL</h1>
                <p class="text-gray-400 max-w-lg">Welcome, {{ Auth::user()->name }}. Review and evaluate verified submissions below.</p>
            </div>
            
            <div class="mt-6 md:mt-0 flex items-center space-x-6 bg-gray-900 border border-gray-800 p-6 rounded-2xl shadow-lg">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $totalPhotos }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Total</p>
                </div>
                <div class="w-px h-12 bg-gray-700"></div>
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-gold mb-1">{{ $judgedCount }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Judged</p>
                </div>
                <div class="w-px h-12 bg-gray-700"></div>
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-blue-500 mb-1">{{ $pendingCount }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Pending</p>
                </div>
            </div>
        </div>

        <!-- Quick Start / Continue Button -->
        <div class="mb-12 flex justify-center" data-aos="zoom-in">
            @if($pendingCount > 0)
                <a href="{{ route('judge.next') }}" class="inline-flex items-center bg-gold hover:bg-yellow-500 text-dark font-bold py-4 px-10 rounded-xl text-lg shadow-xl hover:shadow-gold/20 transition-all transform hover:-translate-y-1">
                    <i data-lucide="play" class="w-6 h-6 mr-3"></i> CONTINUE JUDGING
                </a>
            @else
                <div class="bg-green-500/10 border border-green-500/30 text-green-400 p-4 px-8 rounded-2xl flex items-center shadow-lg">
                    <i data-lucide="check-circle" class="w-6 h-6 mr-3"></i>
                    <span class="font-bold text-lg">All caught up! You have scored every photo.</span>
                </div>
            @endif
        </div>

        <!-- Filters & Groups Selector -->
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-12 shadow-lg" data-aos="fade-up">
            <form action="{{ route('judge.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4 w-full" id="dashboardFilterForm">
                
                <!-- Status Filter -->
                <div class="flex-1">
                    <label class="block text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1.5">Status Penilaian</label>
                    <select name="status" onchange="document.getElementById('dashboardFilterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2.5 focus:ring-gold focus:border-gold w-full cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Belum Dinilai (Pending)</option>
                        <option value="judged" {{ request('status') === 'judged' ? 'selected' : '' }}>Sudah Dinilai (Judged)</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="flex-1">
                    <label class="block text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1.5">Kategori Kamera</label>
                    <select name="category" onchange="document.getElementById('dashboardFilterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2.5 focus:ring-gold focus:border-gold w-full cursor-pointer">
                        <option value="">Semua Kategori</option>
                        <option value="smartphone" {{ request('category') === 'smartphone' ? 'selected' : '' }}>Smartphone</option>
                        <option value="dslr" {{ request('category') === 'dslr' ? 'selected' : '' }}>DSLR / Mirrorless</option>
                    </select>
                </div>

                <!-- Collection Filter -->
                <div class="flex-1">
                    <label class="block text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1.5">Kelompok Foto (Koleksi)</label>
                    <select name="collection_id" onchange="document.getElementById('dashboardFilterForm').submit()" class="bg-gray-800 border border-gray-700 rounded-xl text-sm text-white px-4 py-2.5 focus:ring-gold focus:border-gold w-full cursor-pointer">
                        <option value="">Semua Kelompok</option>
                        @foreach($judgeCollections as $collection)
                            <option value="{{ $collection->id }}" {{ request('collection_id') == $collection->id ? 'selected' : '' }}>
                                {{ $collection->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>

        <!-- Category Grids -->
        <div class="space-y-16">
            @forelse($categories as $categoryName => $photos)
                <div data-aos="fade-up">
                    <div class="flex items-center mb-6">
                        <h2 class="text-2xl font-bold text-white uppercase tracking-wider">{{ $categoryName }}</h2>
                        <span class="ml-4 px-3 py-1 bg-gray-800 text-gray-400 text-xs font-bold rounded-full">{{ $photos->count() }} Photos</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        @foreach($photos as $photo)
                            @php
                                $hasScored = $photo->scores->isNotEmpty();
                            @endphp
                            
                            <a href="{{ route('judge.photo', $photo->id) }}" class="group block relative rounded-2xl overflow-hidden bg-gray-900 border {{ $hasScored ? 'border-gold' : 'border-gray-800' }} hover:border-gold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                                <!-- Bulk Selection Checkbox -->
                                <div class="absolute top-3 left-3 z-20" @click.stop>
                                    <input type="checkbox" 
                                           :value="{{ $photo->id }}" 
                                           x-model="selectedPhotos" 
                                           class="w-5 h-5 rounded border-gray-700 text-gold focus:ring-gold bg-gray-950/80 backdrop-blur-sm cursor-pointer transition-all">
                                </div>

                                <!-- Aspect Ratio Box -->
                                <div class="relative w-full pb-[100%]">
                                    <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" referrerpolicy="no-referrer" alt="{{ $photo->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                </div>
                                
                                <!-- Content -->
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h4 class="text-white font-bold text-sm truncate">{{ $photo->title }}</h4>
                                    <p class="text-xs text-gray-400 mt-1 truncate">{{ $photo->village ?? 'Unknown Village' }}</p>
                                </div>

                                <!-- Status Badge -->
                                @if($hasScored)
                                    <div class="absolute top-3 right-3 w-8 h-8 bg-gold rounded-full flex items-center justify-center shadow-lg transform scale-100 transition-transform">
                                        <i data-lucide="check" class="w-5 h-5 text-dark font-bold"></i>
                                    </div>
                                @else
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="px-4 py-2 bg-gray-900/90 text-white text-xs font-bold rounded-full backdrop-blur-sm border border-gray-700">
                                            Score Now
                                        </div>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-900 rounded-3xl border border-gray-800 border-dashed">
                    <i data-lucide="image-off" class="w-16 h-16 mx-auto text-gray-700 mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">No Verified Photos Yet</h3>
                    <p class="text-gray-500">Wait for the admin team to verify the incoming submissions.</p>
                </div>
            @endforelse
        </div>

        <!-- Floating Bulk Action Bar -->
        <div x-show="selectedPhotos.length > 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-20 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-20 opacity-0"
             class="fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-gray-900/95 border border-gray-800 p-4 px-6 rounded-2xl flex items-center justify-between shadow-2xl z-50 backdrop-blur-md max-w-lg w-[calc(100%-2rem)]"
             style="display: none;">
            <div class="flex items-center space-x-3">
                <span class="w-2 h-2 rounded-full bg-gold animate-pulse"></span>
                <span class="text-sm font-bold text-white"><span x-text="selectedPhotos.length"></span> Foto Terpilih</span>
            </div>
            
            <div class="flex items-center space-x-3">
                <select x-model="bulkCollectionId" class="bg-gray-800 border border-gray-700 rounded-lg text-xs text-white px-3 py-2 focus:ring-gold focus:border-gold cursor-pointer">
                    <option value="">Pilih Kelompok...</option>
                    @foreach($judgeCollections as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                    @endforeach
                </select>
                <button type="button" 
                        @click="bulkAssign(bulkCollectionId)" 
                        :disabled="!bulkCollectionId"
                        :class="bulkCollectionId ? 'bg-gold text-dark hover:bg-yellow-500' : 'bg-gray-800 text-gray-500 cursor-not-allowed border border-gray-700'"
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all">
                    Gabungkan
                </button>
                <button type="button" @click="selectedPhotos = []" class="text-gray-400 hover:text-white text-xs font-medium pl-2">
                    Batal
                </button>
            </div>
        </div>

    </div>
</x-layouts.admin>
