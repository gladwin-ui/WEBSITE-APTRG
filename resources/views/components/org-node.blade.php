@props(['member'])

<div class="bg-surface border border-line rounded-lg p-5 w-64 sm:w-72 mx-auto text-center shadow-sm hover:border-primary transition-colors">
    <img src="{{ asset($member->photo_path ?: 'images/avatar-placeholder.svg') }}" 
         alt="{{ $member->name }}" 
         class="w-20 h-20 mx-auto rounded-full object-cover object-top border-2 border-primary mb-3">
    <h4 class="font-bold text-ink text-sm leading-snug">
        {{ $member->name }}
    </h4>
    <p class="text-xs font-bold text-primary uppercase tracking-wider mt-1">
        {{ $member->position }}
    </p>
    <p class="text-xs text-body mt-2 border-t border-line pt-2">
        {{ $member->study_program }} &bull; {{ $member->batch }}
    </p>
</div>
