<x-layout.app>

<div id="home-root" class="overflow-x-hidden" style="background-color:#000000;">

    {{-- ===== SECTION 1: VIDEO HERO ===== --}}
    <section data-bg="#000000" class="relative h-screen w-full overflow-hidden text-white flex items-center bg-black">
        <!-- Background Video -->
        <video class="absolute inset-0 h-full w-full object-cover"
               src="{{ route('media.stream', 'aptrg-hero.mp4') }}" autoplay muted loop playsinline></video>
        <div class="absolute inset-0" style="background-color: rgba(0,0,0,0.55);"></div>
        
        <!-- Video Hero Text with Scroll Reveal -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 pt-20 w-full text-left">
            <div class="max-w-3xl">
                <h1 class="reveal reveal-up text-3xl sm:text-4xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                    Aeromodelling &amp; Payload Telemetry Research Group
                </h1>
                <div class="reveal reveal-up d-1 h-1.5 w-24 bg-primary my-6"></div>
                <p class="reveal reveal-up d-2 text-lg sm:text-xl font-bold text-white mb-6">
                    &ldquo;{{ $profile?->tagline ?? 'Fight Together, Win Together, Yes We Can' }}&rdquo;
                </p>
                <p class="reveal reveal-up d-3 text-sm sm:text-base text-white/80 leading-relaxed mb-8">
                    Pusat inovasi dan pengembangan teknologi pesawat tanpa awak (UAV), aeromodelling, sistem telemetri muatan, aerial robotics, dan sistem kendali otonom di bawah naungan Fakultas Teknik Elektro, Telkom University.
                </p>
                <div class="reveal reveal-up d-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('profile') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
                        Profil Lab
                    </a>
                    <a href="#about" class="inline-flex items-center justify-center px-6 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold rounded-lg transition-colors shadow-sm">
                        Kegiatan Lab
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center pointer-events-none text-white/60">
            <span class="reveal reveal-up text-xs uppercase tracking-widest font-bold mb-2">Scroll</span>
            <svg class="reveal reveal-up d-1 h-6 w-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>
        </div>
    </section>

    {{-- ===== SECTION 2: TENTANG (putih, teks gelap) ===== --}}
    <section id="about" data-bg="#ffffff" class="relative w-full flex min-h-screen items-center py-20 text-ink bg-white">
        <div class="mx-auto max-w-5xl px-6 sm:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                <!-- Left Column -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-5">
                    <div class="reveal reveal-left">
                        <span class="text-xs font-bold tracking-widest text-primary uppercase">TENTANG</span>
                        <x-section-heading class="mb-4" title="Tentang Laboratorium APTRG" subtitle="Dedikasi riset ilmiah dan kompetisi kedirgantaraan tingkat nasional dan internasional." />
                    </div>
                    <p class="reveal reveal-left d-1 text-body text-base sm:text-[1.08rem] leading-relaxed lg:leading-loose text-ink/90">
                        {{ $profile?->about }}
                    </p>
                    <div class="reveal reveal-left d-2 pt-1">
                        <a href="{{ route('profile') }}" class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors text-sm sm:text-base">
                            Baca Selengkapnya Profil Lab &rarr;
                        </a>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="reveal reveal-right d-1 lg:col-span-5">
                    <div class="bg-canvas border border-line p-6 sm:p-8 rounded-xl text-center shadow-sm">
                        <img src="{{ asset('images/logo-aptrg.svg') }}" alt="APTRG Logo" loading="lazy" decoding="async" class="w-44 sm:w-56 h-44 sm:h-56 mx-auto object-contain mb-4">
                        <h3 class="text-xl sm:text-2xl font-black text-ink leading-tight">{{ $profile?->name }}</h3>
                        <p class="text-sm sm:text-base font-semibold text-primary mt-1.5">{{ $profile?->faculty }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SECTION 3: DIVISI + TIM (merah, teks putih) ===== --}}
    <section data-bg="#C1121F" class="relative w-full flex min-h-screen items-center py-24 text-white" style="background-color: #C1121F;">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-8 grid-cols-1 lg:grid-cols-2 w-full">
            <!-- Column 1: Divisi Laboratorium -->
            <div>
                <h2 class="reveal reveal-left text-2xl sm:text-3xl font-extrabold mb-6 border-b border-white/20 pb-3">4 Divisi Laboratorium</h2>
                <div class="space-y-4">
                    @foreach ($divisions as $d)
                        <div class="reveal reveal-left d-{{ $loop->iteration }} bg-white/10 border border-white/20 hover:bg-white/15 transition-all p-5 rounded-xl shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-white/10 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <x-division-icon :name="$d->icon" class="h-6 w-6 text-white" />
                                </div>
                                <h4 class="font-extrabold text-lg text-white">{{ $d->name }}</h4>
                            </div>
                            <p class="text-xs sm:text-sm text-white/85 mt-2 leading-relaxed">{{ $d->short_description }}</p>
                            <a href="{{ route('divisions.show', $d->slug) }}" class="inline-flex items-center text-xs font-bold text-white/90 hover:text-white mt-3 hover:underline">
                                Detail Divisi &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Column 2: Tim Lomba KRTI -->
            <div>
                <h2 class="reveal reveal-right text-2xl sm:text-3xl font-extrabold mb-6 border-b border-white/20 pb-3">5 Tim Lomba Kompetisi</h2>
                <div class="space-y-4">
                    @foreach ($teams as $t)
                        <div class="reveal reveal-right d-{{ $loop->iteration }} bg-white/10 border border-white/20 hover:bg-white/15 transition-all p-5 rounded-xl shadow-sm">
                            <div class="flex items-start gap-3 mb-2">
                                <div class="p-1 bg-white/10 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <img src="{{ asset($t->logo_path) }}" alt="{{ $t->team_name }}" class="w-10 h-10 object-contain rounded-md" />
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <h4 class="font-extrabold text-lg text-white truncate">{{ $t->team_name }}</h4>
                                        <span class="text-[10px] font-bold bg-white text-primary px-2.5 py-0.5 rounded-full uppercase tracking-wider">{{ $t->krti_division }}</span>
                                    </div>
                                    <p class="text-xs text-white/70 italic mt-0.5">&ldquo;{{ $t->tagline }}&rdquo;</p>
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-white/85 mt-2.5 leading-relaxed">
                                {{ Str::limit($t->description, 110) }}
                            </p>
                            <a href="{{ route('teams.show', $t->slug) }}" class="inline-flex items-center text-xs font-bold text-white/90 hover:text-white mt-3 hover:underline">
                                Spesifikasi &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SECTION 4: SOROTAN / CALL TO ACTION OPREC ===== --}}
    <section data-bg="#0B0B0B" class="relative w-full flex min-h-screen items-center overflow-hidden text-white py-24" style="background-color: #0B0B0B;">
        <!-- Background Team Photo -->
        <img src="{{ asset('images/hero-highlight.webp') }}" alt="APTRG Team" aria-hidden="true" class="absolute inset-0 h-full w-full object-cover object-top">
        <!-- Subtle dark overlay so text is readable -->
        <div class="absolute inset-0" style="background-color: rgba(0,0,0,0.45);"></div>

        <!-- CTA Text — no card/box background, floating directly over photo -->
        <div class="relative z-10 mx-auto max-w-3xl px-6 sm:px-8 w-full text-center">
            <h2 class="reveal reveal-zoom text-2xl sm:text-4xl md:text-5xl font-extrabold tracking-tight leading-tight drop-shadow-[0_2px_16px_rgba(0,0,0,0.9)]">Fight Together, Win Together, Yes We Can</h2>
            <p class="reveal reveal-up d-1 mx-auto mt-6 max-w-2xl text-white/90 text-sm sm:text-base leading-relaxed drop-shadow-[0_2px_8px_rgba(0,0,0,0.8)]">
                Mari bergabung menjadi bagian dari anggota riset laboratorium APTRG.
            </p>
            <a href="https://oprecaptrg-main-3-zip--raffaadhiyaksa2.replit.app" target="_blank" class="reveal reveal-up d-2 mt-8 inline-block rounded-lg bg-primary hover:bg-primary-dark transition-colors px-8 py-4 text-base font-bold text-white shadow-xl">
                Daftar Open Recruitment &rarr;
            </a>
        </div>
    </section>

    {{-- ===== FOOTER (hitam) ===== --}}
    <x-layout.footer data-bg="#000000" />



</div>
</x-layout.app>
