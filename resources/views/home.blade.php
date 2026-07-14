<x-layout.app title="Beranda">
    <!-- HERO SECTION (Background Slideshow with Flat Solid Overlay - NO GRADIENT) -->
    <section class="relative bg-ink text-white border-b border-line overflow-hidden min-h-[85vh] flex flex-col justify-center"
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
            <div class="absolute inset-0 bg-ink/80"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-36 sm:pt-44 pb-20 sm:pb-28">
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
                    <a href="#kegiatan" class="inline-flex items-center justify-center px-6 py-3.5 bg-surface text-ink font-bold rounded-lg hover:bg-canvas transition-colors shadow-sm">
                        Kegiatan Lab
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="bg-canvas py-12 border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <x-stat :value="$stats['divisions_count']" label="Divisi Internal" />
                <x-stat :value="$stats['teams_count']" label="Tim Lomba KRTI" />
                <x-stat :value="$stats['achievements_count'] . '+'" label="Prestasi Meraih Juara" />
                <x-stat :value="$stats['established_year']" label="Tahun Berdiri" />
            </div>
        </div>
    </section>

    <!-- RINGKASAN PROFIL SECTION -->
    <section id="kegiatan" class="py-20 bg-surface border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6">
                    <x-section-heading title="Tentang Laboratorium APTRG" subtitle="Dedikasi riset ilmiah dan kompetisi kedirgantaraan tingkat nasional dan internasional." />
                    <p class="text-body leading-relaxed">
                        {{ $profile?->about }}
                    </p>
                    <div class="pt-4">
                        <a href="{{ route('profile') }}" class="inline-flex items-center font-bold text-primary hover:text-primary-dark transition-colors">
                            Baca Selengkapnya Profil Lab &rarr;
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="bg-canvas border border-line p-8 rounded-lg text-center">
                        <img src="{{ asset('images/logo-aptrg.png') }}" alt="APTRG Logo" class="w-48 h-48 mx-auto rounded-full object-contain shadow-sm mb-6">
                        <h3 class="text-xl font-bold text-ink">{{ $profile?->name }}</h3>
                        <p class="text-sm font-semibold text-primary mt-1">{{ $profile?->faculty }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PREVIEW 4 DIVISI -->
    <section class="py-20 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading title="4 Divisi Laboratorium" subtitle="Struktur fungsional yang bersinergi dalam perancangan wahana terbang lengkap." :centered="true" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                @foreach ($divisions as $div)
                    <x-card class="flex flex-col justify-between p-6 hover:border-primary transition-colors">
                        <div>
                            <h3 class="text-xl font-extrabold text-ink mb-3">{{ $div->name }}</h3>
                            <p class="text-sm text-body leading-relaxed mb-6">{{ $div->short_description }}</p>
                        </div>
                        <a href="{{ route('divisions.show', $div->slug) }}" class="text-sm font-bold text-primary hover:text-primary-dark">
                            Detail Divisi &rarr;
                        </a>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PREVIEW TIM KRTI -->
    <section class="py-20 bg-surface border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Tim Lomba KRTI" subtitle="Lima divisi tim bertanding pada ajang Kontes Robot Terbang Indonesia (Kemdiktisaintek)." :centered="true" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
                @foreach ($teams as $team)
                    <x-card class="p-6 flex flex-col justify-between hover:border-primary transition-colors">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" class="w-14 h-14 rounded object-contain">
                                <x-badge color="red">{{ $team->krti_code }}</x-badge>
                            </div>
                            <h3 class="text-xl font-bold text-ink mb-1">{{ $team->team_name }}</h3>
                            <p class="text-xs font-semibold text-primary uppercase tracking-wider mb-3">{{ $team->krti_division }}</p>
                            <p class="text-sm text-body leading-relaxed mb-4 line-clamp-3">{{ $team->description }}</p>
                        </div>
                        <a href="{{ route('teams.show', $team->slug) }}" class="inline-block text-sm font-bold text-primary hover:text-primary-dark pt-2 border-t border-line">
                            Spesifikasi &amp; Misi &rarr;
                        </a>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PREVIEW PRESTASI TERBARU -->
    <section class="py-20 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <x-section-heading title="Prestasi Terbaru" subtitle="Jejak kebanggaan dan dedikasi APTRG di ajang kompetisi nasional & internasional." />
                <a href="{{ route('achievements.index') }}" class="text-sm font-bold text-primary hover:text-primary-dark mb-10 sm:mb-0">
                    Lihat Semua Prestasi &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($latestAchievements as $ach)
                    <x-card class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <x-badge color="red">{{ $ach->year }}</x-badge>
                            <span class="text-xs font-bold uppercase text-body">{{ $ach->level }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-ink mb-2">{{ $ach->title }}</h3>
                        <p class="text-sm font-semibold text-primary mb-2">{{ $ach->rank }} &bull; {{ $ach->category }}</p>
                        <p class="text-sm text-body leading-relaxed">{{ $ach->description }}</p>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA INSTAGRAM -->
    <section class="py-16 bg-primary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold mb-4">Ikuti Perjalanan Riset &amp; Prestasi APTRG</h2>
            <p class="text-white/90 max-w-xl mx-auto mb-8">
                Dapatkan informasi terbaru mengenai persiapan tim KRTI, pembaruan riset UAV, kegiatan open recruitment, dan aktivitas harian laboratorium kami di Instagram resmi.
            </p>
            <a href="https://instagram.com/aptrg" target="_blank" class="inline-flex items-center px-8 py-3.5 bg-white text-primary font-bold rounded-lg hover:bg-canvas transition-colors">
                Kunjungi Instagram @aptrg
            </a>
        </div>
    </section>
</x-layout.app>
