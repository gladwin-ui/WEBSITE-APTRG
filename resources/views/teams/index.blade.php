<x-layout.app title="Tim Lomba">
<section class="mx-auto max-w-6xl px-6 py-12">

    {{-- Heading + intro ringkas --}}
    <div class="mb-8 max-w-2xl">
        <x-section-heading title="Tim Lomba APTRG" />
        <p class="mt-3 text-body">Lima tim wahana terbang otonom yang mewakili Telkom University pada kompetisi nasional dan internasional seperti KRTI dan TEKNOFEST. Arahkan atau klik untuk menjelajahi tiap tim.</p>
    </div>

    {{-- ============ DESKTOP: ACCORDION HORIZONTAL (md ke atas) ============ --}}
    <div x-data="{ active: -1 }" x-cloak
         @mouseleave="active = -1"
         class="hidden gap-3 md:flex"
         style="height: 72vh; min-height: 540px;">

        @foreach ($teams as $team)
            @php $i = $loop->index; @endphp
            <div
                @mouseenter="active = {{ $i }}"
                @click="active = {{ $i }}"
                :style="{ flexGrow: active === {{ $i }} ? 6 : (active === -1 ? 1 : 0) }"
                style="flex-basis: 80px;"
                class="relative cursor-pointer overflow-hidden rounded-xl border border-line transition-[flex-grow] duration-500 ease-in-out"
                :class="active === {{ $i }} ? 'bg-primary' : 'bg-surface hover:border-primary'">

                {{-- Konten aktif --}}
                <div x-show="active === {{ $i }}" x-transition:enter.delay.150ms class="h-full">
                    <x-team-panel-body :team="$team" :image="$teamsData[$i]['image']" />
                </div>

                {{-- Strip nonaktif --}}
                <div x-show="active !== {{ $i }}" class="grid grid-rows-3 h-full w-full items-center justify-items-center py-6">
                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" loading="lazy" decoding="async" class="h-9 w-9 object-contain self-start" />
                    <div></div>
                    <span class="whitespace-nowrap text-sm tracking-wider text-body self-end"
                          style="writing-mode: vertical-rl; transform: rotate(180deg);">{{ $team->team_name }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ============ MOBILE: ACCORDION VERTIKAL (di bawah md) ============ --}}
    <div x-data="{
            active: -1,
            toggle(i) {
                this.active = this.active === i ? -1 : i;
            }
         }"
         x-cloak class="flex flex-col gap-3 md:hidden">
        @foreach ($teams as $team)
            @php $i = $loop->index; @endphp
            <div class="overflow-hidden rounded-xl border border-line transition-colors duration-300"
                 :class="active === {{ $i }} ? 'bg-primary' : 'bg-surface'">

                <button type="button" @click="toggle({{ $i }})"
                    class="flex w-full items-center gap-3 p-4 text-left">
                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" loading="lazy" decoding="async" class="h-9 w-9 object-contain" />
                    <span class="flex-1 font-semibold"
                          :class="active === {{ $i }} ? 'text-white' : 'text-ink'">{{ $team->team_name }}</span>
                    <span class="text-sm font-bold"
                          :class="active === {{ $i }} ? 'text-white/70' : 'text-body/40'">{{ str_pad($team->order, 2, '0', STR_PAD_LEFT) }}</span>
                    <svg class="h-5 w-5 transition-transform duration-300" :class="active === {{ $i }} ? 'rotate-180 text-white' : 'text-body'"
                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </button>

                {{-- Panel body dengan max-height transition untuk animasi smooth --}}
                <div x-ref="panel{{ $i }}"
                     class="overflow-hidden transition-[max-height,opacity] duration-500 ease-in-out"
                     :style="active === {{ $i }}
                         ? 'max-height: ' + ($refs.panel{{ $i }}.scrollHeight) + 'px; opacity: 1;'
                         : 'max-height: 0px; opacity: 0;'">
                    <div class="px-4 pb-5">
                        <x-team-panel-body :team="$team" :image="$teamsData[$i]['image']" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</section>
</x-layout.app>
