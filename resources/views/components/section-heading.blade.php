@props(['title', 'subtitle' => null, 'centered' => false])

<div class="{{ $centered ? 'text-center' : '' }} mb-10">
    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-ink">
        {{ $title }}
    </h2>
    <div class="h-1 w-20 bg-primary mt-3 {{ $centered ? 'mx-auto' : '' }}"></div>
    @if ($subtitle)
        <p class="mt-3 text-sm sm:text-base text-body leading-relaxed max-w-2xl {{ $centered ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
