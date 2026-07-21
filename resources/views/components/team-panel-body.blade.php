@props(['team', 'image' => null])
@php
    $specs = is_array($team->specs) ? $team->specs : (json_decode($team->specs, true) ?? []);
    $top = array_slice($specs, 0, 3, true);
@endphp

<div class="relative h-full w-full overflow-hidden">
    {{-- FOTO LATAR --}}
    @if ($image)
        <img src="{{ $image }}" alt="" aria-hidden="true"
             class="absolute inset-0 h-full w-full object-cover">
    @endif

    {{-- OVERLAY SOLID (bukan gradient). Tanpa foto → merah penuh --}}
    <div class="absolute inset-0"
         style="background-color: {{ $image ? 'rgba(193,18,31,0.82)' : '#C1121F' }};"></div>

    {{-- KONTEN: logo/nomor di atas, SEMUA teks menyatu di bawah --}}
    <div class="relative flex h-full flex-col p-6 text-white md:p-8">

        {{-- ATAS: hanya logo + nomor (hanya tampil di desktop) --}}
        <div class="hidden md:flex items-start justify-between">
            <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" class="h-12 w-12 rounded-lg bg-white/90 object-contain p-1">
            <span class="text-4xl font-bold leading-none md:text-5xl">{{ str_pad($team->order, 2, '0', STR_PAD_LEFT) }}</span>
        </div>

        {{-- BAWAH: judul + divisi + tagline + deskripsi + spesifikasi (SATU blok) --}}
        <div class="mt-auto">
            <h3 class="text-2xl font-bold md:text-3xl uppercase tracking-wide">{{ $team->team_name }}</h3>
            <p class="mt-1 text-xs font-bold uppercase tracking-wider text-white/80">{{ $team->krti_division }} &middot; {{ $team->krti_code }}</p>
            @if ($team->tagline)
                <p class="mt-2 text-xs italic text-white/85">&ldquo;{{ $team->tagline }}&rdquo;</p>
            @endif
            <p class="mt-2 max-w-md text-sm leading-relaxed text-white/85 line-clamp-3">{{ $team->description }}</p>

            <ul class="mt-4 space-y-1.5">
                @foreach ($top as $key => $value)
                    <li class="flex items-center gap-2 text-xs text-white/90">
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>{{ $key }}: {{ $value }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-5 flex items-center justify-end border-t border-white/25 pt-4">
                <a href="{{ route('teams.show', $team->slug) }}"
                   class="inline-flex items-center gap-1.5 rounded-full bg-white px-4 py-2 text-xs font-semibold text-primary hover:bg-white/90">
                    Lihat Misi &amp; Spesifikasi
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>
