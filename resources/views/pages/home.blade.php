<x-layouts.app>
    <!-- HERO SECTION -->
    <section class="relative min-h-screen py-24 md:py-32 flex items-center justify-center overflow-hidden">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-paser.jpg') }}" 
                 alt="Hero Background - Petani Sawit Paser" 
                 class="w-full h-full object-cover" 
                 x-data
                 x-init="window.addEventListener('scroll', () => { $el.style.transform = `translateY(${window.scrollY * 0.4}px)` })"
             >
            <div class="absolute inset-0 bg-dark/70"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-12 md:mt-20">
            <h1 class="font-heading text-5xl md:text-8xl lg:text-9xl text-white mb-4 md:mb-6 tracking-tight text-shadow-premium" data-aos="zoom-in" data-aos-duration="1200">
                KASIINFO PHOTO<br>CHALLENGE 2026
            </h1>
            <p class="font-heading text-2xl md:text-5xl text-gold mb-4 md:mb-6 tracking-widest uppercase" data-aos="fade-up" data-aos-delay="400">
                Roda Juang Bumi Paser
            </p>
            <p class="text-lg md:text-2xl text-gray-300 font-light mb-6 md:mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="600">
                "Dari tangan-tangan sederhana lahir kemajuan Bumi Paser."
            </p>

            <!-- COUNTDOWN TIMER -->
            <div class="mb-6 md:mb-10 max-w-sm md:max-w-md mx-auto bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl md:rounded-3xl p-3 md:p-5 shadow-2xl" 
                 data-aos="fade-up" 
                 data-aos-delay="700"
                 x-data="countdownTimer('2026-08-07T23:59:59+08:00')">
                
                <template x-if="!isExpired">
                    <div>
                        <span class="text-[10px] md:text-xs uppercase tracking-widest text-gold font-bold mb-2 md:mb-3 block">Sisa Waktu Pengumpulan Karya</span>
                        <div class="grid grid-cols-4 gap-1.5 md:gap-2.5 text-white">
                            <!-- Days -->
                            <div class="bg-dark/60 rounded-xl md:rounded-2xl py-2 px-1 md:p-3 border border-white/5 flex flex-col justify-center items-center shadow-inner">
                                <span class="text-xl md:text-3xl font-mono font-bold text-gold" x-text="days">00</span>
                                <span class="text-[7px] md:text-[9px] text-gray-400 uppercase tracking-widest mt-1">Hari</span>
                            </div>
                            <!-- Hours -->
                            <div class="bg-dark/60 rounded-xl md:rounded-2xl py-2 px-1 md:p-3 border border-white/5 flex flex-col justify-center items-center shadow-inner">
                                <span class="text-xl md:text-3xl font-mono font-bold text-gold" x-text="hours">00</span>
                                <span class="text-[7px] md:text-[9px] text-gray-400 uppercase tracking-widest mt-1">Jam</span>
                            </div>
                            <!-- Minutes -->
                            <div class="bg-dark/60 rounded-xl md:rounded-2xl py-2 px-1 md:p-3 border border-white/5 flex flex-col justify-center items-center shadow-inner">
                                <span class="text-xl md:text-3xl font-mono font-bold text-gold" x-text="minutes">00</span>
                                <span class="text-[7px] md:text-[9px] text-gray-400 uppercase tracking-widest mt-1">Menit</span>
                            </div>
                            <!-- Seconds -->
                            <div class="bg-dark/60 rounded-xl md:rounded-2xl py-2 px-1 md:p-3 border border-white/5 flex flex-col justify-center items-center shadow-inner animate-pulse">
                                <span class="text-xl md:text-3xl font-mono font-bold text-red-400" x-text="seconds">00</span>
                                <span class="text-[7px] md:text-[9px] text-gray-400 uppercase tracking-widest mt-1">Detik</span>
                            </div>
                        </div>
                    </div>
                </template>
                
                <template x-if="isExpired">
                    <div class="py-1 md:py-2">
                        <span class="px-2 py-0.5 md:px-3 md:py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] md:text-xs font-bold uppercase tracking-wider rounded-full inline-block mb-1.5 md:mb-2">
                            Closed
                        </span>
                        <h4 class="text-white font-bold text-base md:text-lg">Pengumpulan Karya Telah Ditutup</h4>
                        <p class="text-gray-400 text-[10px] md:text-xs mt-1">Terima kasih atas partisipasi Anda. Nantikan pengumuman pemenang!</p>
                    </div>
                </template>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4 flex-wrap" data-aos="fade-up" data-aos-delay="800">
                <a href="{{ url('/register') }}" class="bg-gold text-dark px-6 py-3 md:px-8 md:py-4 rounded-full font-bold text-base md:text-lg hover:bg-yellow-500 hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(212,175,55,0.5)] w-full sm:w-auto text-center mb-3 sm:mb-0">
                    Daftar Sekarang
                </a>
                <a href="{{ route('track.index') }}" class="bg-gray-900/50 backdrop-blur-md border border-gray-700 hover:border-gold text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold text-base md:text-lg hover:bg-gray-800 transition-all duration-300 w-full sm:w-auto text-center flex items-center justify-center mb-3 sm:mb-0">
                    <i data-lucide="search" class="w-4 h-4 mr-2"></i> Cek Status Karya
                </a>
                <a href="{{ url('/guidebook') }}" class="bg-white/10 backdrop-blur-md border border-white/30 text-white px-6 py-3 md:px-8 md:py-4 rounded-full font-bold text-base md:text-lg hover:bg-white/20 transition-all duration-300 w-full sm:w-auto text-center">
                    Baca Panduan
                </a>
            </div>

            @if(isset($totalSubmissions) && $totalSubmissions >= 50)
            <div class="mt-12 flex items-center justify-center space-x-4" data-aos="fade-up" data-aos-delay="1000">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-dark object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="Photographer 1">
                    <img class="w-10 h-10 rounded-full border-2 border-dark object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="Photographer 2">
                    <img class="w-10 h-10 rounded-full border-2 border-dark object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Photographer 3">
                    <div class="w-10 h-10 rounded-full border-2 border-dark bg-gray-800 flex items-center justify-center text-white text-xs font-bold shadow-inner">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="text-left">
                    <div class="text-gray-300 font-medium text-sm">Bergabunglah bersama</div>
                    <div class="text-white font-bold text-lg"><span class="text-gold text-xl">{{ number_format($totalSubmissions) }}+</span> fotografer lainnya</div>
                </div>
            </div>
            @endif
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-10 hidden lg:flex flex-col items-center animate-bounce" data-aos="fade-in" data-aos-delay="1200">
            <i data-lucide="camera" class="w-8 h-8 text-gold mb-2 opacity-80"></i>
            <span class="text-xs text-white uppercase tracking-widest">Gulir Ke Bawah</span>
            <i data-lucide="chevron-down" class="w-5 h-5 text-white"></i>
        </div>
    </section>

    <!-- ABOUT TEASER -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <x-ui.section-title title="Merekam Semangat Paser" subtitle="Tentang Kompetisi">
                        <p class="mb-6 text-gray-600">
                            Kasiinfo Photo Challenge merupakan kompetisi fotografi untuk mendokumentasikan semangat masyarakat Kabupaten Paser sekaligus meningkatkan apresiasi terhadap profesi yang menggerakkan roda kehidupan daerah.
                        </p>
                        <a href="{{ url('/about') }}" class="inline-flex items-center text-dark font-bold hover:text-gold transition-colors group">
                            Pelajari Selengkapnya <i data-lucide="arrow-right" class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </x-ui.section-title>
                </div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-left">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="Petugas Kebersihan Paser - Unsung Hero" class="w-full h-auto object-cover aspect-[4/3] transform hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-ui.section-title title="Kategori Kompetisi" subtitle="Pilih Senjatamu" centered="true" />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto mt-16">
                <x-ui.card-category 
                    title="Smartphone" 
                    image="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1780&auto=format&fit=crop"
                    link="{{ url('/categories#smartphone') }}"
                    delay="100">
                    Bebas berekspresi dengan kamera bawaan Android atau iPhone di saku Anda.
                </x-ui.card-category>

                <x-ui.card-category 
                    title="DSLR / Mirrorless" 
                    image="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1964&auto=format&fit=crop"
                    link="{{ url('/categories#dslr') }}"
                    delay="300">
                    Untuk antusias dan profesional. Kebebasan kreatif tanpa batas dengan lensa lepas tukar.
                </x-ui.card-category>
            </div>
        </div>
    </section>

    <!-- TIMELINE TEASER -->
    <section class="py-24 bg-dark text-white relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gold rounded-full filter blur-[150px] opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-kasi-red rounded-full filter blur-[150px] opacity-20 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <x-ui.section-title title="Menuju Puncak" subtitle="Jadwal Acara" light="true">
                        Tandai kalender Anda. Perjalanan untuk memamerkan karya terbaik Anda dimulai di sini.
                    </x-ui.section-title>
                    <a href="{{ url('/timeline') }}" class="inline-block mt-8 bg-gold text-dark px-8 py-3 rounded-full font-bold hover:bg-white transition-colors duration-300">
                        Lihat Jadwal Lengkap
                    </a>
                </div>
                
                <div class="space-y-0 relative">
                    <x-ui.timeline-item date="13 Juli 2026" title="Pendaftaran Dibuka" active="true">
                        Pengumpulan karya resmi dimulai melalui form website.
                    </x-ui.timeline-item>
                    <x-ui.timeline-item date="7 Agustus 2026" title="Batas Akhir Pengumpulan">
                        Hari terakhir untuk mendaftarkan dan mengirimkan karya foto Anda.
                    </x-ui.timeline-item>
                    <x-ui.timeline-item date="17 Agustus 2026" title="Pengumuman Pemenang" last="true">
                        Puncak acara pengumuman juara bertepatan dengan Hari Kemerdekaan.
                    </x-ui.timeline-item>
                </div>
            </div>
        </div>
    </section>

    <!-- SPONSORS CAROUSEL -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h4 class="text-center font-heading text-2xl text-gray-400 mb-12 tracking-widest uppercase">Supported By</h4>
            
            <div class="swiper sponsors-swiper">
                <div class="swiper-wrapper items-center">
                    <!-- ABC Net -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_abcnet.png') }}" alt="ABC Net Logo" class="h-12 w-auto object-contain">
                    </div>
                    <!-- Hotto -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_hotto.png') }}" alt="Hotto Logo" class="h-12 w-auto object-contain">
                    </div>
                    <!-- ABC Net (Repeated for loop smoothness) -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_abcnet.png') }}" alt="ABC Net Logo" class="h-12 w-auto object-contain">
                    </div>
                    <!-- Hotto (Repeated for loop smoothness) -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_hotto.png') }}" alt="Hotto Logo" class="h-12 w-auto object-contain">
                    </div>
                    <!-- ABC Net (Repeated for loop smoothness) -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_abcnet.png') }}" alt="ABC Net Logo" class="h-12 w-auto object-contain">
                    </div>
                    <!-- Hotto (Repeated for loop smoothness) -->
                    <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                        <img src="{{ asset('images/sponsor/logo_hotto.png') }}" alt="Hotto Logo" class="h-12 w-auto object-contain">
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>

<!-- Swiper Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.sponsors-swiper', {
                modules: [SwiperModules.Autoplay],
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: { slidesPerView: 3 },
                    768: { slidesPerView: 4 },
                    1024: { slidesPerView: 5 },
                }
            });
        }
    });

    // AlpineJS Countdown Timer
    function countdownTimer(target) {
        return {
            targetDate: new Date(target).getTime(),
            days: '00',
            hours: '00',
            minutes: '00',
            seconds: '00',
            isExpired: false,
            timer: null,
            init() {
                this.update();
                this.timer = setInterval(() => {
                    this.update();
                }, 1000);
            },
            update() {
                const now = new Date().getTime();
                const distance = this.targetDate - now;

                if (distance < 0) {
                    clearInterval(this.timer);
                    this.isExpired = true;
                    this.days = '00';
                    this.hours = '00';
                    this.minutes = '00';
                    this.seconds = '00';
                    return;
                }

                const d = Math.floor(distance / (1000 * 60 * 60 * 24));
                const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((distance % (1000 * 60)) / 1000);

                this.days = d.toString().padStart(2, '0');
                this.hours = h.toString().padStart(2, '0');
                this.minutes = m.toString().padStart(2, '0');
                this.seconds = s.toString().padStart(2, '0');
            }
        }
    }
</script>
