@props(['variant' => 'primary'])

@php
$classes = ($variant === 'ghost') ? 'bg-transparent text-purple-700 hover:bg-purple-100' : 'bg-purple-600 text-white hover:bg-purple-700';
@endphp

<button class="px-4 py-2 rounded {{ $classes }}">
    {{ $slot }}
</button>
