@props(['color' => 'red'])

@php
    $classes = match ($color) {
        'red' => 'bg-primary text-white',
        'gray' => 'bg-canvas text-ink border border-line',
        'dark' => 'bg-ink text-white',
        default => 'bg-primary text-white',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider {$classes}"]) }}>
    {{ $slot }}
</span>
