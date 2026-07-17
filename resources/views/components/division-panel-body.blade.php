@props(['division'])
@php
    $resp = is_array($division->responsibilities)
        ? $division->responsibilities
        : (json_decode($division->responsibilities, true) ?? []);
    $top = array_slice($resp, 0, 3);
    $c = $division->coordinator;
    $img = $division->image_path;
@endphp

<div class="relative h-full w-full overflow-hidden">
    {{-- FOTO LATAR --}}
    @if ($img)
        <img src="{{ asset($img) }}" alt="" aria-hidden="true"
             class="absolute inset-0 h-full w-full object-cover">
    @endif

    {{-- OVERLAY SOLID (bukan gradient). Tanpa foto → merah penuh --}}
    <div class="absolute inset-0"
         style="background-color: {{ $img ? 'rgba(193,18,31,0.82)' : '#C1121F' }};"></div>

    {{-- KONTEN: ikon/nomor di atas, SEMUA teks menyatu di bawah --}}
    <div class="relative flex h-full flex-col p-6 text-white md:p-8">

        {{-- ATAS: hanya ikon + nomor (hanya tampil di desktop) --}}
        <div class="hidden md:flex items-start justify-between">
            <x-division-icon :name="$division->icon" class="h-8 w-8" />
            <span class="text-4xl font-bold leading-none md:text-5xl">{{ str_pad($division->order, 2, '0', STR_PAD_LEFT) }}</span>
        </div>

        {{-- BAWAH: judul + deskripsi + tanggung jawab + koordinator (SATU blok) --}}
        <div class="mt-auto">
            <h3 class="text-2xl font-bold md:text-3xl uppercase tracking-wide">{{ str_ireplace('divisi ', '', $division->name) }}</h3>
            <p class="mt-2 max-w-md text-sm leading-relaxed text-white/85">{{ $division->short_description }}</p>

            <ul class="mt-4 space-y-1.5">
                @foreach ($top as $item)
                    <li class="flex items-center gap-2 text-xs text-white/90">
                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-white"></span>{{ $item }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-5 flex items-center justify-end border-t border-white/25 pt-4">
                <a href="{{ route('divisions.show', $division->slug) }}"
                   class="inline-flex items-center gap-1.5 rounded-full bg-white px-4 py-2 text-xs font-semibold text-primary hover:bg-white/90">
                    Detail
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>