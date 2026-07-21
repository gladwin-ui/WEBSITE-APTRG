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
                <p class="reveal reveal-up d-2 text-lg sm:text-xl font-bold text-primary-light mb-6">
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
    <section id="about" data-bg="#ffffff" class="relative w-full flex min-h-screen items-center py-24 text-ink bg-white">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left Column -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-6">
                    <div class="reveal reveal-left">
                        <span class="text-xs font-bold tracking-widest text-primary uppercase">TENTANG</span>
                        <x-section-heading title="Tentang Laboratorium APTRG" subtitle="Dedikasi riset ilmiah dan kompetisi kedirgantaraan tingkat nasional dan internasional." />
                    </div>
                    <p class="reveal reveal-left d-1 text-body text-sm sm:text-base leading-relaxed">
                        {{ $profile?->about }}
                    </p>
                    <div class="reveal reveal-left d-2 pt-2">
                        <a href="{{ route('profile') }}" class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors text-sm sm:text-base">
                            Baca Selengkapnya Profil Lab &rarr;
                        </a>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="reveal reveal-right d-1 lg:col-span-5">
                    <div class="bg-canvas border border-line p-6 sm:p-8 rounded-xl text-center shadow-sm">
                        <img src="{{ asset('images/logo-aptrg.svg') }}" alt="APTRG Logo" loading="lazy" decoding="async" class="w-32 sm:w-48 h-32 sm:h-48 mx-auto object-contain mb-4">
                        <h3 class="text-lg sm:text-xl font-bold text-ink">{{ $profile?->name }}</h3>
                        <p class="text-xs sm:text-sm font-semibold text-primary mt-1">{{ $profile?->faculty }}</p>
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
    <footer data-bg="#000000" class="w-full bg-black text-white pt-16 pb-8 px-6 sm:px-8">
        <div class="max-w-5xl mx-auto">

            <!-- Logo + Tagline -->
            <div class="reveal reveal-up flex flex-col items-center text-center mb-10">
                <img src="{{ asset('images/logo-aptrg.svg') }}" alt="APTRG Logo" class="h-24 w-24 mb-4 object-contain">
                <h2 class="text-2xl font-black tracking-widest uppercase text-white">APTRG</h2>
                <p class="text-xs text-white/50 mt-1">Aeromodelling and Payload Telemetry Research Group</p>
                <p class="text-sm italic text-primary mt-2">"Fight Together, Win Together, Yes We Can"</p>
            </div>

            <!-- Social Media Icons -->
            <div class="reveal reveal-up d-1 flex justify-center gap-5 mb-10">
                <!-- Instagram -->
                <a href="https://www.instagram.com/aptrg/" target="_blank" title="Instagram APTRG"
                   class="group flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </a>
                <!-- YouTube -->
                <a href="https://www.youtube.com/@APTRGLaboratory" target="_blank" title="YouTube APTRG"
                   class="group flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                        <path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.108C19.516 3.5 12 3.5 12 3.5s-7.517 0-9.388.555A3.003 3.003 0 00.5 6.163C0 8.07 0 12 0 12s0 3.93.5 5.837a3.003 3.003 0 002.11 2.108c1.871.555 9.388.555 9.388.555s7.516 0 9.388-.555a3.003 3.003 0 002.11-2.108C24 15.93 24 12 24 12s0-3.93-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
                <!-- TikTok -->
                <a href="https://www.tiktok.com/@aptrg_telkomuniversity" target="_blank" title="TikTok APTRG"
                   class="group flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.59 4.14.99 1.15 2.37 1.91 3.88 2.15v3.62c-1.34-.17-2.61-.73-3.66-1.58-1.07-.86-1.85-2.02-2.28-3.32-.05.88-.04 1.76-.04 2.64v8.32c-.04 1.4-.41 2.81-1.15 3.99-.86 1.39-2.23 2.45-3.83 2.94-1.63.5-3.41.45-5.01-.13-1.62-.59-3-1.8-3.79-3.38-.83-1.62-1.01-3.53-.5-5.26.5-1.68 1.63-3.15 3.19-4.04 1.48-.86 3.25-1.12 4.9-.73 0 1.25.01 2.5 0 3.75-.82-.23-1.72-.15-2.47.24-.76.4-1.32 1.11-1.54 1.94-.21.84-.04 1.75.46 2.44.47.66 1.22 1.09 2.02 1.18.82.1 1.66-.14 2.27-.7.68-.61.98-1.55.97-2.45V.02z"/>
                    </svg>
                </a>
            </div>

            <!-- Divider -->
            <div class="reveal reveal-up d-1 border-t border-white/10 mb-8"></div>

            <!-- Contact Info Row -->
            <div class="reveal reveal-up d-2 grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 text-center">
                <div>
                    <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Telepon</span>
                    <span class="text-sm text-white/80">+62 822-1234-5678</span>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Email</span>
                    <span class="text-sm text-white/80">aptrg@telkomuniversity.ac.id</span>
                </div>
                <div>
                    <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Lokasi</span>
                    <span class="text-sm text-white/80">Gedung FTE Lt. 3, Telkom University</span>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-white/10 mb-6"></div>

            <!-- Bottom Bar -->
            <div class="reveal reveal-up d-3 flex flex-col items-center gap-4 text-xs text-white/40 sm:flex-row sm:justify-between">
                <span class="text-center">© {{ date('Y') }} APTRG Telkom University. All rights reserved.</span>
                <div class="flex flex-wrap justify-center items-center gap-x-4 gap-y-2">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                    <a href="{{ route('profile') }}" class="hover:text-white transition-colors">Profil</a>
                    <a href="{{ route('divisions.index') }}" class="hover:text-white transition-colors">Divisi</a>
                    <a href="{{ route('teams.index') }}" class="hover:text-white transition-colors">Tim Lomba</a>
                    <a href="{{ route('achievements.index') }}" class="hover:text-white transition-colors">Prestasi</a>
                </div>
            </div>

        </div>
    </footer>



</div>
</x-layout.app>
