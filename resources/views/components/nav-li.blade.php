@props(['id', 'icon', 'active' => false])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-3 rounded-lg bg-blue-500 text-white font-semibold shadow-lg scale-105 transition-colors duration-200'
            : 'flex items-center p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200';
@endphp

<li class="mb-4">
    <a id="{{ $id }}" {{ $attributes->merge(['class' => $classes]) }}>
        <span class="sidebar-link-icon-container">
            <i class="{{ $icon }}"></i>
        </span>
        <span class="sidebar-link-text">{{ $slot }}</span>
    </a>
</li>
