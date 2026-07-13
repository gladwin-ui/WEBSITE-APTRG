@props(['value', 'label'])

<div class="bg-surface border border-line p-6 rounded-lg text-center">
    <div class="text-3xl sm:text-4xl font-extrabold text-primary tracking-tight">
        {{ $value }}
    </div>
    <div class="mt-2 text-xs sm:text-sm font-semibold uppercase tracking-wide text-body">
        {{ $label }}
    </div>
</div>
