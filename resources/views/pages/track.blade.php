<x-layouts.app title="Cek Status Karya - Kasilomba">
    
    <div class="pt-32 pb-20 min-h-screen bg-dark">
        <div class="max-w-3xl mx-auto px-6">
            
            <div class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-4xl md:text-5xl font-heading text-white tracking-widest mb-4">CEK STATUS KARYA</h1>
                <p class="text-gray-400 text-lg">Pantau progres verifikasi dan penilaian karya Anda.</p>
            </div>

            <!-- Search Form -->
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 md:p-8 shadow-2xl mb-12" data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('track.search') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">@</span>
                        </div>
                        <input type="text" name="instagram" value="{{ $username ?? old('instagram') }}" required
                               class="w-full pl-10 pr-4 py-4 bg-gray-800 border border-gray-700 rounded-xl text-white focus:ring-2 focus:ring-gold focus:border-gold placeholder-gray-500 transition-all text-lg"
                               placeholder="username_instagram">
                    </div>
                    <button type="submit" class="bg-gold hover:bg-yellow-500 text-dark font-bold px-8 py-4 rounded-xl shadow-[0_0_15px_rgba(212,175,55,0.3)] transition-all md:w-auto w-full flex justify-center items-center">
                        <i data-lucide="search" class="w-5 h-5 mr-2"></i> Lacak
                    </button>
                </form>
                
                @if(session('error'))
                <div class="mt-6 p-4 bg-red-500/10 border border-red-500/30 rounded-xl flex items-start">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-0.5"></i>
                    <p class="text-red-400 text-sm">{{ session('error') }}</p>
                </div>
                @endif
            </div>

            <!-- Tracking Result -->
            @if(isset($photo) && isset($status))
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 md:p-10 shadow-2xl" data-aos="fade-up">
                
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6 mb-10 pb-10 border-b border-gray-800">
                    <div class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-gray-700 flex-shrink-0">
                        <img src="{{ $photo->thumbnail_url ?? $photo->google_drive_preview }}" alt="Thumbnail" class="w-full h-full object-cover">
                    </div>
                    <div class="text-center md:text-left">
                        <span class="px-3 py-1 bg-gray-800 text-gold text-xs font-bold uppercase tracking-widest rounded-full mb-3 inline-block">
                            {{ $photo->category }}
                        </span>
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $photo->title }}</h2>
                        <p class="text-gray-400 text-sm mb-1">Peserta: <span class="text-gray-200 font-medium">{{ $photo->participant_name }}</span></p>
                        <p class="text-gray-400 text-sm">Terkirim: <span class="text-gray-200">{{ $photo->created_at->format('d M Y, H:i') }}</span></p>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="relative">
                    <!-- Status Banner -->
                    <div class="mb-8 p-6 rounded-xl border {{ $status['bg'] }} flex flex-col items-center text-center">
                        <h3 class="text-xl font-bold {{ $status['color'] }} mb-2">{{ $status['title'] }}</h3>
                        <p class="text-gray-300 text-sm">{!! $status['message'] !!}</p>
                    </div>

                    @if($status['step'] > 0)
                    <!-- Progress Steps -->
                    <div class="flex flex-col md:flex-row justify-between relative mt-12">
                        <!-- Connecting Line (Desktop) -->
                        <div class="hidden md:block absolute top-5 left-10 right-10 h-0.5 bg-gray-800 z-0"></div>
                        <div class="hidden md:block absolute top-5 left-10 h-0.5 bg-gold z-0 transition-all duration-1000" 
                             style="width: {{ $status['step'] == 1 ? '0%' : ($status['step'] == 2 ? '50%' : '100%') }}"></div>

                        <!-- Connecting Line (Mobile) -->
                        <div class="md:hidden absolute left-5 top-10 bottom-10 w-0.5 bg-gray-800 z-0"></div>
                        <div class="md:hidden absolute left-5 top-10 w-0.5 bg-gold z-0 transition-all duration-1000" 
                             style="height: {{ $status['step'] == 1 ? '0%' : ($status['step'] == 2 ? '50%' : '100%') }}"></div>

                        <!-- Step 1 -->
                        <div class="relative z-10 flex flex-row md:flex-col items-center mb-8 md:mb-0 w-full md:w-1/3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-0 md:mb-3 flex-shrink-0 {{ $status['step'] >= 1 ? 'bg-gold text-dark shadow-[0_0_15px_rgba(212,175,55,0.5)]' : 'bg-gray-800 text-gray-500' }}">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <div class="ml-4 md:ml-0 text-left md:text-center">
                                <h4 class="text-white font-bold text-sm">Terupload</h4>
                                <p class="text-gray-500 text-xs mt-1">Data Diterima</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative z-10 flex flex-row md:flex-col items-center mb-8 md:mb-0 w-full md:w-1/3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-0 md:mb-3 flex-shrink-0 {{ $status['step'] >= 2 ? 'bg-gold text-dark shadow-[0_0_15px_rgba(212,175,55,0.5)]' : 'bg-gray-800 text-gray-500' }}">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </div>
                            <div class="ml-4 md:ml-0 text-left md:text-center">
                                <h4 class="text-white font-bold text-sm">Terverifikasi</h4>
                                <p class="text-gray-500 text-xs mt-1">Sesuai Kriteria</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative z-10 flex flex-row md:flex-col items-center w-full md:w-1/3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm mb-0 md:mb-3 flex-shrink-0 {{ $status['step'] >= 3 ? 'bg-gold text-dark shadow-[0_0_15px_rgba(212,175,55,0.5)]' : 'bg-gray-800 text-gray-500' }}">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div class="ml-4 md:ml-0 text-left md:text-center">
                                <h4 class="text-white font-bold text-sm">Selesai Dinilai</h4>
                                <p class="text-gray-500 text-xs mt-1">Menunggu Pengumuman</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            @endif

        </div>
    </div>
</x-layouts.app>
