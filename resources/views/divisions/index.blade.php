<x-layout.app title="Divisi Laboratorium">
<section class="mx-auto max-w-6xl px-6 py-12">

    {{-- Heading + intro ringkas --}}
    <div class="mb-8 max-w-2xl">
        <x-section-heading title="Divisi Laboratorium" />
        <p class="mt-3 text-body">Empat divisi yang menggerakkan riset dan kompetisi APTRG — dari perancangan wahana hingga pengelolaan organisasi. Arahkan atau klik untuk menjelajahi tiap divisi.</p>
    </div>

    {{-- ============ DESKTOP: ACCORDION HORIZONTAL (md ke atas) ============ --}}
    <div x-data="{ active: 0 }" x-cloak
         class="hidden gap-3 md:flex"
         style="height: 72vh; min-height: 540px;">

        @foreach ($divisions as $division)
            @php $i = $loop->index; @endphp
            <div
                @mouseenter="active = {{ $i }}"
                @click="active = {{ $i }}"
                :style="{ flexGrow: active === {{ $i }} ? 6 : 0 }"
                style="flex-basis: 80px;"
                class="relative cursor-pointer overflow-hidden rounded-xl border border-line transition-[flex-grow] duration-500 ease-in-out"
                :class="active === {{ $i }} ? 'bg-primary' : 'bg-surface hover:border-primary'">

                {{-- Konten aktif --}}
                <div x-show="active === {{ $i }}" x-transition:enter.delay.150ms class="h-full">
                    <x-division-panel-body :division="$division" />
                </div>

                {{-- Strip nonaktif --}}
                <div x-show="active !== {{ $i }}" class="flex h-full flex-col items-center justify-between py-6">
                    <span class="text-xl font-bold text-body/40">{{ str_pad($division->order, 2, '0', STR_PAD_LEFT) }}</span>
                    <x-division-icon :name="$division->icon" class="h-6 w-6 text-primary" />
                    <span class="whitespace-nowrap text-sm tracking-wider text-body"
                          style="writing-mode: vertical-rl; transform: rotate(180deg);">{{ $division->name }}</span>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ============ MOBILE: ACCORDION VERTIKAL (di bawah md) ============ --}}
    <div x-data="{ active: 0 }" x-cloak class="flex flex-col gap-3 md:hidden">
        @foreach ($divisions as $division)
            @php $i = $loop->index; @endphp
            <div class="overflow-hidden rounded-xl border border-line transition-colors"
                 :class="active === {{ $i }} ? 'bg-primary' : 'bg-surface'">

                <button type="button" @click="active = (active === {{ $i }} ? -1 : {{ $i }})"
                    class="flex w-full items-center gap-3 p-4 text-left">
                    <x-division-icon :name="$division->icon" class="h-6 w-6"
                        ::class="active === {{ $i }} ? 'text-white' : 'text-primary'" />
                    <span class="flex-1 font-semibold"
                          :class="active === {{ $i }} ? 'text-white' : 'text-ink'">{{ $division->name }}</span>
                    <span class="text-sm font-bold"
                          :class="active === {{ $i }} ? 'text-white/70' : 'text-body/40'">{{ str_pad($division->order, 2, '0', STR_PAD_LEFT) }}</span>
                    <svg class="h-5 w-5 transition-transform" :class="active === {{ $i }} ? 'rotate-180 text-white' : 'text-body'"
                         fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
                </button>

                <div x-show="active === {{ $i }}" x-transition class="px-4 pb-5">
                    <x-division-panel-body :division="$division" />
                </div>
            </div>
        @endforeach
    </div>

</section>
</x-layout.app>
