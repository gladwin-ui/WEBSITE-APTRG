<x-layout.app :fullpage="true" title="Beranda">

    {{-- CONTAINER SCROLL UTAMA: inilah yang di-scroll, bukan body (LANGKAH 2) --}}
    <main class="h-screen w-full overflow-y-scroll snap-y snap-proximity scroll-smooth no-scrollbar">

        {{-- SECTION 1: HERO --}}
        <section id="hero"
            class="h-screen w-full snap-start flex items-center justify-center relative bg-ink text-white border-b border-line"
            x-data="{ activeSlide: 1 }"
            x-init="setInterval(() => { activeSlide = activeSlide === 1 ? 2 : 1 }, 6000)">
            <!-- Background Images -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/bg-hero-1.jpg') }}" alt="APTRG Landing Background 1"
                     fetchpriority="high"
                     loading="eager"
                     x-show="activeSlide === 1"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="w-full h-full object-cover object-top absolute inset-0">
                <img src="{{ asset('images/bg-hero-2.jpg') }}" alt="APTRG Landing Background 2"
                     x-show="activeSlide === 2"
                     x-cloak
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 scale-105"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-1000"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="w-full h-full object-cover object-top absolute inset-0">
                <!-- Flat Solid Overlay (NO GRADIENT) -->
                <div class="absolute inset-0 bg-ink/60"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 w-full fade-in">
                <div class="max-w-3xl">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Aeromodelling &amp; Payload Telemetry Research Group
                    </h1>
                    <div class="h-1.5 w-24 bg-primary my-6"></div>
                    <p class="text-xl sm:text-2xl font-bold text-primary-light mb-6">
                        &ldquo;{{ $profile?->tagline ?? 'Fight Together, Win Together, Yes We Can' }}&rdquo;
                    </p>
                    <p class="text-base sm:text-lg text-line leading-relaxed mb-8">
                        Pusat inovasi dan pengembangan teknologi pesawat tanpa awak (UAV), aeromodelling, sistem telemetri muatan, aerial robotics, dan sistem kendali otonom di bawah naungan Fakultas Teknik Elektro, Telkom University.
                    </p>
                    <div class="flex flex-wrap items-center gap-4">
                        <a href="{{ route('profile') }}" class="inline-flex items-center justify-center px-6 py-3.5 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
                            Profil Lab
                        </a>
                        <a href="#tentang-lab" class="inline-flex items-center justify-center px-6 py-3.5 bg-surface text-ink font-bold rounded-lg hover:bg-canvas transition-colors shadow-sm">
                            Kegiatan Lab
                        </a>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center pointer-events-none">
                <span class="text-[10px] uppercase tracking-widest text-line/80 font-bold mb-2">Scroll</span>
                <div class="w-5 h-8 border-2 border-line/60 rounded-full flex justify-center pt-1.5">
                    <div class="w-1 h-2.5 bg-primary rounded-full animate-bounce"></div>
                </div>
            </div>
        </section>

        {{-- SECTION 2: TENTANG + STATISTIK --}}
        <section id="tentang-lab"
            class="min-h-screen w-full snap-start flex flex-col justify-center py-16 bg-surface border-b border-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full my-auto fade-in">
                <!-- Tentang Laboratorium APTRG -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center mb-10 sm:mb-14">
                    <div class="lg:col-span-7 space-y-4 sm:space-y-6">
                        <x-section-heading title="Tentang Laboratorium APTRG" subtitle="Dedikasi riset ilmiah dan kompetisi kedirgantaraan tingkat nasional dan internasional." />
                        <p class="text-body text-sm sm:text-base leading-relaxed">
                            {{ $profile?->about }}
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('profile') }}" class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors text-sm sm:text-base">
                                Baca Selengkapnya Profil Lab &rarr;
                            </a>
                        </div>
                    </div>
                    <div class="lg:col-span-5">
                        <div class="bg-canvas border border-line p-6 sm:p-8 rounded-xl text-center shadow-sm">
                            <img src="{{ asset('images/logo-aptrg.png') }}" alt="APTRG Logo" class="w-32 sm:w-40 h-32 sm:h-40 mx-auto rounded-full object-contain shadow-sm mb-4">
                            <h3 class="text-lg sm:text-xl font-bold text-ink">{{ $profile?->name }}</h3>
                            <p class="text-xs sm:text-sm font-semibold text-primary mt-1">{{ $profile?->faculty }}</p>
                        </div>
                    </div>
                </div>

                <!-- Angka Statistik -->
                <div class="pt-8 sm:pt-10 border-t border-line">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <x-stat :value="$stats['divisions_count']" label="Divisi Internal" />
                        <x-stat :value="$stats['teams_count']" label="Tim Lomba KRTI" />
                        <x-stat :value="$stats['achievements_count'] . '+'" label="Prestasi Meraih Juara" />
                        <x-stat :value="$stats['established_year']" label="Tahun Berdiri" />
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 3: DIVISI + TIM KRTI --}}
        <section id="divisi-tim"
            class="min-h-screen w-full snap-start flex flex-col justify-center py-16 bg-canvas border-b border-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full my-auto fade-in">
                <x-section-heading title="Divisi Riset & Tim Lomba KRTI" subtitle="Empat divisi internal laboratorium dan lima tim kompetisi Kontes Robot Terbang Indonesia." :centered="true" />

                <!-- Baris 1: 4 Divisi Internal (Melebar Horisontal 4 Kolom) -->
                <div class="mt-6 sm:mt-8 mb-8 sm:mb-10">
                    <div class="flex items-center justify-between mb-3 border-b-2 border-primary pb-2">
                        <h3 class="text-base sm:text-lg font-bold text-ink uppercase tracking-wider">4 Divisi Internal</h3>
                        <a href="{{ route('divisions.index') }}" class="text-xs sm:text-sm font-bold text-primary hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                        @foreach ($divisions as $div)
                            <x-card class="p-4 sm:p-5 flex flex-col justify-between hover:border-primary transition-colors h-full shadow-sm">
                                <div>
                                    <h4 class="font-extrabold text-ink text-base sm:text-lg mb-1.5">{{ $div->name }}</h4>
                                    <p class="text-xs sm:text-sm text-body leading-relaxed line-clamp-2 mb-4">{{ $div->short_description }}</p>
                                </div>
                                <a href="{{ route('divisions.show', $div->slug) }}" class="text-xs sm:text-sm font-bold text-primary hover:text-primary-dark mt-auto pt-2 border-t border-line">
                                    Detail Divisi &rarr;
                                </a>
                            </x-card>
                        @endforeach
                    </div>
                </div>

                <!-- Baris 2: 5 Tim Lomba KRTI (Melebar Horisontal 5 Kolom) -->
                <div>
                    <div class="flex items-center justify-between mb-3 border-b-2 border-primary pb-2">
                        <h3 class="text-base sm:text-lg font-bold text-ink uppercase tracking-wider">5 Tim Lomba KRTI</h3>
                        <a href="{{ route('teams.index') }}" class="text-xs sm:text-sm font-bold text-primary hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
                        @foreach ($teams as $team)
                            <x-card class="p-3.5 sm:p-4 flex flex-col items-center text-center justify-between hover:border-primary transition-colors h-full shadow-sm">
                                <div class="flex flex-col items-center w-full min-w-0">
                                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded object-contain mb-2 flex-shrink-0">
                                    <x-badge color="red" class="mb-1.5">{{ $team->krti_code }}</x-badge>
                                    <h4 class="font-bold text-ink text-sm sm:text-base truncate w-full">{{ $team->team_name }}</h4>
                                    <p class="text-[10px] sm:text-[11px] text-primary font-semibold uppercase tracking-wider truncate w-full">{{ $team->krti_division }}</p>
                                </div>
                                <a href="{{ route('teams.show', $team->slug) }}" class="w-full text-xs font-bold text-primary hover:text-primary-dark mt-3 pt-2 border-t border-line block">
                                    Spesifikasi &rarr;
                                </a>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 4: PRESTASI + CTA INSTAGRAM --}}
        <section id="prestasi-cta"
            class="min-h-screen w-full snap-start flex flex-col justify-center py-16 bg-surface border-b border-line">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full my-auto fade-in">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 sm:mb-10">
                    <x-section-heading title="Prestasi Terbaru" subtitle="Jejak kebanggaan dan dedikasi APTRG di ajang kompetisi kedirgantaraan." />
                    <a href="{{ route('achievements.index') }}" class="text-sm font-bold text-primary hover:text-primary-dark mb-6 sm:mb-0">
                        Lihat Semua Prestasi &rarr;
                    </a>
                </div>

                <!-- 3 Kartu Prestasi -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10 sm:mb-12">
                    @foreach ($latestAchievements as $ach)
                        <x-card class="p-5 sm:p-6 flex flex-col justify-between h-full">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <x-badge color="red">{{ $ach->year }}</x-badge>
                                    <span class="text-xs font-bold uppercase text-body">{{ $ach->level }}</span>
                                </div>
                                <h3 class="text-base sm:text-lg font-bold text-ink mb-2">{{ $ach->title }}</h3>
                                <p class="text-xs sm:text-sm font-semibold text-primary mb-2">{{ $ach->rank }} &bull; {{ $ach->category }}</p>
                                <p class="text-xs sm:text-sm text-body leading-relaxed line-clamp-3">{{ $ach->description }}</p>
                            </div>
                        </x-card>
                    @endforeach
                </div>

                <!-- Ikuti Perjalanan Riset APTRG -->
                <div class="bg-primary text-white rounded-2xl p-6 sm:p-8 shadow-md flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="space-y-2 text-center sm:text-left max-w-2xl">
                        <h3 class="text-xl sm:text-2xl font-extrabold leading-tight">Ikuti Perjalanan Riset &amp; Prestasi APTRG</h3>
                        <p class="text-white/90 text-xs sm:text-sm leading-relaxed">
                            Dapatkan informasi terbaru persiapan tim KRTI, pembaruan riset UAV, kegiatan open recruitment, dan aktivitas harian laboratorium kami di Instagram resmi.
                        </p>
                    </div>
                    <a href="https://instagram.com/aptrg" target="_blank" class="flex-shrink-0 inline-flex items-center px-6 py-3 bg-white text-primary font-bold rounded-lg hover:bg-canvas transition-colors shadow-sm text-sm sm:text-base">
                        Kunjungi Instagram @aptrg &rarr;
                    </a>
                </div>
            </div>
        </section>

        {{-- SECTION 5: FOOTER (LANGKAH 2) --}}
        <section id="footer-section"
            class="min-h-screen w-full snap-start flex flex-col justify-end">
            <x-layout.footer :fullpage="true" />
        </section>

    </main>

    @push('scripts')
    <script>
    // Trigger fade-in via IntersectionObserver
    const scroller = document.querySelector('main.snap-y');
    const sections = document.querySelectorAll('main.snap-y section');

    if (scroller && sections.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.fade-in').forEach(el => el.classList.add('is-visible'));
                }
            });
        }, { root: scroller, threshold: 0.5 });

        sections.forEach(s => observer.observe(s));
    }
    </script>
    @endpush
</x-layout.app>
