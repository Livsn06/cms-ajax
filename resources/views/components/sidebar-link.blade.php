@props(['active' => false])

@php
    $classes =
        $active ?? false
            ? 'flex items-center gap-3 px-4 py-3 bg-orange-50 text-orange-700 rounded-lg font-semibold transition-all'
            : 'flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 rounded-lg transition-all';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
