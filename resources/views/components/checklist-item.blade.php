@props(['label', 'passed' => false])

<div class="flex items-start space-x-3 group">
    @if($passed)
        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5"></i>
        <span class="text-sm text-gray-300">{{ $label }}</span>
    @else
        <i data-lucide="alert-circle" class="w-5 h-5 text-kasi-red flex-shrink-0 mt-0.5"></i>
        <span class="text-sm text-kasi-red font-medium">{{ $label }} <span class="text-xs text-gray-500 ml-1 font-normal">(Missing)</span></span>
    @endif
</div>
