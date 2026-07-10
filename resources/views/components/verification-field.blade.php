@props(['label', 'value'])

<div class="mb-2">
    <span class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">{{ $label }}</span>
    <span class="block text-sm text-gray-200 break-words {{ empty($value) ? 'italic text-gray-600' : '' }}">
        {{ $value ?: 'Not Provided' }}
    </span>
</div>
