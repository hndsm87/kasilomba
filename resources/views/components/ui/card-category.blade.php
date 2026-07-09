@props(['title', 'image', 'link' => '#', 'delay' => '0'])

<a href="{{ $link }}" 
   class="group relative block overflow-hidden rounded-2xl shadow-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl aspect-[4/5] md:aspect-[3/4]"
   data-aos="fade-up" 
   data-aos-delay="{{ $delay }}">
   
    <!-- Background Image -->
    <img src="{{ $image }}" alt="{{ $title }}" class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" />
    
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
    
    <!-- Content -->
    <div class="absolute inset-0 flex flex-col justify-end p-8">
        <h3 class="font-heading text-4xl text-white tracking-wide mb-2 text-shadow-premium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
            {{ $title }}
        </h3>
        
        @if(isset($slot) && $slot->isNotEmpty())
            <div class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 transform translate-y-4 group-hover:translate-y-0">
                {{ $slot }}
            </div>
        @endif
        
        <!-- Animated Arrow -->
        <div class="mt-6 flex items-center text-gold font-semibold text-sm uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-x-[-10px] group-hover:translate-x-0">
            Explore <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
        </div>
    </div>
</a>
