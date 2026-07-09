@props(['title', 'subtitle' => '', 'centered' => false, 'light' => false])

<div class="mb-12 {{ $centered ? 'text-center mx-auto max-w-3xl' : '' }}">
    @if($subtitle)
        <span class="text-gold font-bold tracking-wider text-sm uppercase mb-3 block" data-aos="fade-up">{{ $subtitle }}</span>
    @endif
    <h2 class="font-heading text-5xl md:text-6xl mb-6 {{ $light ? 'text-white' : 'text-dark' }}" data-aos="fade-up" data-aos-delay="100">
        {{ $title }}
    </h2>
    @if(isset($slot) && $slot->isNotEmpty())
        <div class="text-lg {{ $light ? 'text-gray-300' : 'text-gray-600' }} leading-relaxed" data-aos="fade-up" data-aos-delay="200">
            {{ $slot }}
        </div>
    @endif
</div>
