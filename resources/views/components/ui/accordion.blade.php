@props(['title', 'active' => false])

<div x-data="{ open: {{ $active ? 'true' : 'false' }} }" class="border-b border-gray-200 py-4">
    <button @click="open = !open" class="flex justify-between items-center w-full text-left focus:outline-none group">
        <h3 class="text-xl font-medium text-dark group-hover:text-gold transition-colors duration-200 pr-8">
            {{ $title }}
        </h3>
        <span class="text-gray-400 group-hover:text-gold transition-colors duration-200 transform" :class="{'rotate-180': open}">
            <i data-lucide="chevron-down" class="w-6 h-6"></i>
        </span>
    </button>
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         x-cloak
         class="pt-4 text-gray-600 leading-relaxed">
        {{ $slot }}
    </div>
</div>
