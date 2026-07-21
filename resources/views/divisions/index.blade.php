<x-layout.app title="Divisi Laboratorium">

{{-- ====== DESKTOP: TIMED CARDS (GSAP, klik-saja) ====== --}}
<div class="tc-scene">
    <div id="demo"></div>
    <div class="tc-overlay"></div>

    {{-- dua panel detail (bergantian even/odd saat transisi) --}}
    @foreach (['even', 'odd'] as $p)
    <div class="details" id="details-{{ $p }}">
        <div class="place-box"><div class="text">&mdash;</div></div>
        <div class="title-box-1"><div class="title-1">&mdash;</div></div>
        <div class="title-box-2"><div class="title-2">&mdash;</div></div>
        <div class="desc">&mdash;</div>
        <div class="cta">
            <button class="discover">Lihat Detail Divisi</button>
        </div>
    </div>
    @endforeach

    <div class="pagination" id="pagination">
        <div class="arrow arrow-left" aria-label="Sebelumnya">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        </div>
        <div class="arrow arrow-right" aria-label="Berikutnya">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </div>
    </div>

    <div class="cover"></div>
</div>

{{-- ====== MOBILE: LAYOUT SEDERHANA ====== --}}
<div class="tc-mobile bg-[#1a1a1a] px-6 py-10">
    <h1 class="mb-6 text-2xl font-bold text-white">Divisi Laboratorium</h1>
    <div class="space-y-4">
        @foreach ($divisions as $d)
            <a href="{{ route('divisions.show', $d->slug) }}" class="relative block h-56 overflow-hidden rounded-xl">
                <img src="{{ $divisionsData[$loop->index]['image'] }}" alt="{{ $d->name }}" loading="lazy" decoding="async" class="absolute inset-0 h-full w-full object-cover">
                <div class="absolute inset-0" style="background-color: rgba(15,20,30,0.55);"></div>
                <div class="relative flex h-full flex-col justify-end p-4 text-white">
                    <span class="text-xl font-bold">{{ $d->name }}</span>
                    <span class="mt-1 text-xs text-white/80 line-clamp-2">{{ $d->short_description }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>

{{-- data untuk JS --}}
<script>window.TC_ITEMS = @json($divisionsData);</script>

</x-layout.app>
