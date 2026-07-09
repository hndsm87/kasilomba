@props(['date', 'title', 'active' => false, 'last' => false])

<div class="relative pl-8 sm:pl-32 py-6 group" data-aos="fade-up">
    <!-- Timeline Line -->
    @if(!$last)
        <div class="absolute left-4 sm:left-[7.5rem] top-10 bottom-[-2.5rem] w-0.5 bg-gray-200 group-hover:bg-gold/30 transition-colors duration-500"></div>
    @endif
    
    <!-- Timeline Dot -->
    <div class="absolute left-2.5 sm:left-[6.8rem] top-8 w-3.5 h-3.5 rounded-full border-2 {{ $active ? 'border-gold bg-gold shadow-[0_0_10px_rgba(212,175,55,0.6)]' : 'border-gray-300 bg-white group-hover:border-gold' }} transition-all duration-300 z-10"></div>
    
    <!-- Date (Desktop) -->
    <div class="hidden sm:block absolute left-0 top-6 w-24 text-right">
        <span class="text-sm font-bold text-gray-500 {{ $active ? 'text-gold' : '' }} group-hover:text-gold transition-colors duration-300">{{ $date }}</span>
    </div>
    
    <!-- Content -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 group-hover:shadow-md group-hover:border-gold/20 transition-all duration-300 transform group-hover:-translate-y-1">
        <!-- Date (Mobile) -->
        <div class="sm:hidden mb-2">
            <span class="text-xs font-bold text-gray-500 {{ $active ? 'text-gold' : '' }}">{{ $date }}</span>
        </div>
        <h3 class="font-heading text-2xl text-dark mb-2">{{ $title }}</h3>
        @if(isset($slot) && $slot->isNotEmpty())
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $slot }}
            </p>
        @endif
    </div>
</div>
