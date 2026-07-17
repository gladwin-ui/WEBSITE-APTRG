@props(['member', 'class' => 'w-64 sm:w-72'])

<div class="bg-surface border border-line rounded-lg p-5 {{ $class }} mx-auto text-center shadow-sm hover:border-primary transition-colors flex flex-col justify-between h-full">
    <div class="flex flex-col flex-grow justify-start">
        <img src="{{ asset($member->photo_path ?: 'images/avatar-placeholder.svg') }}"
             alt="{{ $member->name }}"
             loading="lazy" decoding="async"
             class="w-20 h-20 mx-auto rounded-full object-cover object-top border-2 border-primary mb-3 shadow-sm">
        <h4 class="font-bold text-ink text-sm leading-snug min-h-[2.75rem] flex items-center justify-center mb-1">
            {{ $member->name }}
        </h4>
        <p class="text-xs font-bold text-primary uppercase tracking-wider mt-auto mb-2">
            {{ $member->position }}
        </p>
    </div>
    <p class="text-xs text-body mt-3 border-t border-line pt-3">
        {{ $member->study_program }} &bull; {{ $member->batch }}
    </p>
</div>
