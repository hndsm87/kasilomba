<x-layouts.app>
    <!-- HERO SECTION -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Parallax Background -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop" 
                 alt="Hero Background" 
                 class="w-full h-full object-cover" 
                 x-data
                 x-init="window.addEventListener('scroll', () => { $el.style.transform = `translateY(${window.scrollY * 0.4}px)` })"
            >
            <div class="absolute inset-0 bg-dark/70"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-20">
            <h1 class="font-heading text-6xl md:text-8xl lg:text-9xl text-white mb-6 tracking-tight text-shadow-premium" data-aos="zoom-in" data-aos-duration="1200">
                KASIINFO PHOTO<br>CHALLENGE 2026
            </h1>
            <p class="font-heading text-3xl md:text-5xl text-gold mb-8 tracking-widest uppercase" data-aos="fade-up" data-aos-delay="400">
                Roda Juang Bumi Paser
            </p>
            <p class="text-xl md:text-2xl text-gray-300 font-light mb-12 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="600">
                "Dari tangan-tangan sederhana lahir kemajuan Bumi Paser."
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6" data-aos="fade-up" data-aos-delay="800">
                <a href="{{ url('/register') }}" class="bg-gold text-dark px-10 py-4 rounded-full font-bold text-lg hover:bg-yellow-500 hover:scale-105 transition-all duration-300 shadow-[0_0_20px_rgba(212,175,55,0.5)] w-full sm:w-auto">
                    Register Now
                </a>
                <a href="{{ url('/guidebook') }}" class="bg-white/10 backdrop-blur-md border border-white/30 text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition-all duration-300 w-full sm:w-auto">
                    Read Guidebook
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 flex flex-col items-center animate-bounce" data-aos="fade-in" data-aos-delay="1200">
            <i data-lucide="camera" class="w-8 h-8 text-gold mb-2 opacity-80"></i>
            <span class="text-xs text-white uppercase tracking-widest">Scroll</span>
            <i data-lucide="chevron-down" class="w-5 h-5 text-white"></i>
        </div>
    </section>

    <!-- ABOUT TEASER -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <x-ui.section-title title="The Exhibition of Progress" subtitle="About The Challenge">
                        <p class="mb-6 text-gray-600">
                            Kabupaten Paser is evolving. This competition is a stage to capture the untold stories of simple hands building the future. Show us the human interest, the documentary, the raw reality of progress.
                        </p>
                        <a href="{{ url('/about') }}" class="inline-flex items-center text-dark font-bold hover:text-gold transition-colors group">
                            Discover the Vision <i data-lucide="arrow-right" class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </x-ui.section-title>
                </div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1517409081512-42171120eb5a?q=80&w=2070&auto=format&fit=crop" alt="Photography" class="w-full h-auto object-cover aspect-[4/3] transform hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-ui.section-title title="Competition Categories" subtitle="Choose Your Gear" centered="true" />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto mt-16">
                <x-ui.card-category 
                    title="Smartphone" 
                    image="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=1780&auto=format&fit=crop"
                    link="{{ url('/categories#smartphone') }}"
                    delay="100">
                    Accessible to everyone. Capture stunning moments using only the camera in your pocket.
                </x-ui.card-category>

                <x-ui.card-category 
                    title="DSLR / Mirrorless" 
                    image="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1964&auto=format&fit=crop"
                    link="{{ url('/categories#dslr') }}"
                    delay="300">
                    For the enthusiasts and professionals. Unrestricted creative freedom with interchangeable lenses.
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
                    <x-ui.section-title title="Journey to the Top" subtitle="Event Timeline" light="true">
                        Mark your calendars. The journey to becoming the best photographer in Paser starts here.
                    </x-ui.section-title>
                    <a href="{{ url('/timeline') }}" class="inline-block mt-8 bg-gold text-dark px-8 py-3 rounded-full font-bold hover:bg-white transition-colors duration-300">
                        View Full Timeline
                    </a>
                </div>
                
                <div class="space-y-0 relative">
                    <x-ui.timeline-item date="Aug 1, 2026" title="Registration Opens" active="true">
                        Start submitting your best photos through our official portal.
                    </x-ui.timeline-item>
                    <x-ui.timeline-item date="Sep 15, 2026" title="Registration Closes">
                        The final deadline for all photo submissions.
                    </x-ui.timeline-item>
                    <x-ui.timeline-item date="Oct 1, 2026" title="Top 10 Announcement" last="true">
                        The judges reveal the finalists who will proceed to the voting phase.
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
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="swiper-slide text-center flex justify-center opacity-50 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                            <!-- Placeholder Sponsor Logo -->
                            <div class="h-16 flex items-center justify-center font-bold text-2xl text-gray-400 font-heading">
                                SPONSOR {{ $i }}
                            </div>
                        </div>
                    @endfor
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
</script>
