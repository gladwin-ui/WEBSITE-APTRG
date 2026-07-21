<x-layout.app :title="$division->name">

{{-- ============ 1. HERO BANNER ============ --}}
<section class="relative">
    <div class="relative h-64 w-full overflow-hidden md:h-80">
        {{-- Foto banner divisi (fallback placeholder bila kosong) --}}
        <img src="{{ $division->image_path ? asset($division->image_path) : asset('images/bg-hero-1.webp') }}"
             alt="Dokumentasi {{ $division->name }}"
             fetchpriority="high"
             class="h-full w-full object-cover object-[50%_40%]">
        {{-- Overlay SOLID (bukan gradient) --}}
        <div class="absolute inset-0" style="background-color: rgba(15,20,30,0.6);"></div>

        {{-- Konten hero rata kiri --}}
        <div class="absolute inset-0 flex items-center">
            <div class="mx-auto w-full max-w-6xl px-6">
                <a href="{{ route('divisions.index') }}"
                   class="reveal reveal-left mb-3 inline-flex items-center gap-1.5 text-xs font-medium tracking-wide text-white/80 hover:text-white">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/></svg>
                    Kembali ke Divisi
                </a>
                <div class="reveal reveal-left d-1 mb-3">
                    <span class="inline-block rounded-full bg-primary px-3 py-1 text-xs font-semibold text-white">
                        {{ str_pad($division->order, 2, '0', STR_PAD_LEFT) }} · Divisi Internal
                    </span>
                </div>
                <h1 class="reveal reveal-left d-2 text-3xl font-bold text-white md:text-4xl">{{ $division->name }}</h1>
                <p class="reveal reveal-left d-3 mt-2 max-w-xl text-sm text-white/85 md:text-base">{{ $division->short_description }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ============ 2. SPOTLIGHT KOORDINATOR (menimpa hero) ============ --}}
@if ($coordinator)
<section class="mx-auto max-w-6xl px-6">
    {{-- -mt menarik kartu naik menimpa hero; z-10 agar di atas --}}
    <div class="relative z-10 -mt-16 rounded-2xl border border-line bg-surface p-6 shadow-md md:-mt-20 md:p-8">
        <div class="flex flex-col items-center gap-6 text-center md:flex-row md:items-center md:text-left">
            {{-- FOTO BESAR (bintang halaman) --}}
            <div class="reveal reveal-zoom shrink-0">
                <img src="{{ $coordinator->photo_path ? asset($coordinator->photo_path) : asset('images/avatar-placeholder.svg') }}"
                     alt="{{ $coordinator->name }}"
                     class="h-32 w-32 rounded-full border-4 border-primary object-cover object-center md:h-40 md:w-40 shadow-md">
            </div>
            {{-- IDENTITAS --}}
            <div class="reveal reveal-right d-1 min-w-0">
                <span class="text-xs font-bold uppercase tracking-widest text-primary">Koordinator Divisi</span>
                <h2 class="mt-1 text-2xl font-bold text-ink md:text-3xl">{{ $coordinator->name }}</h2>
                <p class="mt-1 font-semibold text-primary">{{ $coordinator->position }}</p>
                <p class="mt-1 text-sm text-body">{{ $coordinator->study_program }} · Angkatan {{ $coordinator->batch }}</p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============ 3. BODY DUA KOLOM ============ --}}
<section class="mx-auto max-w-6xl px-6 py-12">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

        {{-- KIRI: konten utama (2/3) --}}
        <div class="space-y-10 lg:col-span-2">

            {{-- Tentang --}}
            <div>
                <div class="reveal reveal-left">
                    <x-section-heading title="Tentang Divisi" />
                </div>
                <p class="reveal reveal-left d-1 mt-4 leading-relaxed text-body text-base sm:text-lg">{{ $division->description }}</p>
            </div>

            {{-- Tanggung jawab: list beraksen garis merah --}}
            <div>
                <div class="reveal reveal-left mb-4">
                    <x-section-heading title="Tanggung Jawab" />
                </div>
                <div class="space-y-2.5">
                    @foreach ($responsibilities as $item)
                        <div class="reveal reveal-left d-{{ $loop->iteration }} border-l-4 border-primary bg-canvas px-4 py-3 text-sm font-medium text-ink shadow-sm">
                            {{ $item }}
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- KANAN: sidebar sticky (1/3) --}}
        <aside class="lg:col-span-1">
            <div class="lg:sticky lg:top-24 space-y-4">
                <div class="reveal reveal-right rounded-xl border border-line bg-surface p-5 shadow-sm">
                    <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-primary">Sekilas Divisi</h3>
                    <dl class="space-y-3 text-sm">
                        @php
                            $memberCount = match($division->slug) {
                                'mekanik' => 6,
                                'sistem' => 7,
                                'gcs' => 4,
                                'non-technical' => 5,
                                default => 0
                            };
                        @endphp
                        <div class="flex items-center justify-between border-b border-line pb-3">
                            <dt class="text-body">Jumlah Anggota</dt>
                            <dd class="font-semibold text-ink">{{ $memberCount }} Orang</dd>
                        </div>
                        <div class="flex items-center justify-between border-b border-line pb-3">
                            <dt class="text-body">Jumlah tanggung jawab</dt>
                            <dd class="font-semibold text-ink">{{ count($responsibilities) }}</dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-body">Koordinator</dt>
                            <dd class="font-semibold text-ink text-right">{{ $coordinator?->name ?? '—' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </aside>

    </div>
</section>

{{-- ============ 4. GALERI VARIATIF ============ --}}
<section class="mx-auto max-w-6xl px-6 pb-16">
    <div class="reveal reveal-up">
        <x-section-heading title="Dokumentasi & Kegiatan" />
        <p class="mt-3 text-body">Potret aktivitas riset, perancangan, dan eksperimen {{ $division->name }}.</p>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
        {{-- Foto utama besar (2 kolom) --}}
        <div class="reveal reveal-left d-1 group relative overflow-hidden rounded-xl md:col-span-2 border border-line bg-canvas">
            <img src="{{ $division->image_path ? asset($division->image_path) : asset('images/bg-hero-1.webp') }}" alt="Dokumentasi utama {{ $division->name }}"
                 loading="lazy" decoding="async"
                 class="h-72 w-full object-cover transition group-hover:scale-105">
            <div class="absolute inset-x-0 bottom-0 p-4" style="background-color: rgba(15,20,30,0.55);">
                <span class="text-sm font-semibold text-white">Aktivitas Riset & Pengembangan</span>
            </div>
        </div>
        {{-- Dua thumbnail bertumpuk --}}
        <div class="reveal reveal-right d-2 grid grid-rows-2 gap-4">
            <div class="overflow-hidden rounded-xl border border-line bg-canvas">
                <img src="{{ asset('images/bg-hero-1.webp') }}" alt="Kegiatan {{ $division->name }} 1" loading="lazy" decoding="async" class="h-full w-full object-cover">
            </div>
            <div class="overflow-hidden rounded-xl border border-line bg-canvas">
                <img src="{{ asset('images/bg-hero-2.webp') }}" alt="Kegiatan {{ $division->name }} 2" loading="lazy" decoding="async" class="h-full w-full object-cover">
            </div>
        </div>
    </div>
</section>

</x-layout.app>
