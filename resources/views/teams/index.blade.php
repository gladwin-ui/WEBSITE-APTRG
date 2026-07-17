<x-layout.app title="Tim Lomba">
    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Tim Lomba APTRG</h1>
            <p class="text-body mt-2">Lima tim wahana terbang otonom yang mewakili Telkom University pada kompetisi nasional dan internasional seperti KRTI dan TEKNOFEST.</p>
        </div>
    </section>

    <!-- TEAMS GRID -->
    <section class="py-16 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 3 Tim Atas (Baris 1: 3 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($teams->take(3) as $team)
                    <x-card class="p-8 flex flex-col justify-between hover:border-primary transition-colors h-full">
                        <div>
                            <!-- Header Logo & Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" loading="lazy" decoding="async" class="w-16 h-16 rounded-lg object-contain">
                                <x-badge color="red">{{ $team->krti_code }}</x-badge>
                            </div>

                            <!-- Title & Division -->
                            <h2 class="text-2xl font-bold text-ink mb-1">{{ $team->team_name }}</h2>
                            <p class="text-xs font-bold text-primary uppercase tracking-wider mb-4">{{ $team->krti_division }}</p>
                            @if ($team->tagline)
                                <p class="text-xs italic text-body mb-4">&ldquo;{{ $team->tagline }}&rdquo;</p>
                            @endif

                            <p class="text-sm text-body leading-relaxed mb-6">{{ $team->description }}</p>
                        </div>

                        <div class="pt-4 border-t border-line flex justify-end">
                            <a href="{{ route('teams.show', $team->slug) }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white text-sm font-bold rounded hover:bg-primary-dark transition-colors">
                                Lihat Misi &amp; Spesifikasi &rarr;
                            </a>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <!-- 2 Tim Bawah (Baris 2: Di Tengah Antara Yang 3 Di Atas) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mt-8">
                @foreach ($teams->slice(3) as $team)
                    <x-card class="p-8 flex flex-col justify-between hover:border-primary transition-colors h-full">
                        <div>
                            <!-- Header Logo & Badge -->
                            <div class="flex items-center justify-between mb-6">
                                <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" loading="lazy" decoding="async" class="w-16 h-16 rounded-lg object-contain">
                                <x-badge color="red">{{ $team->krti_code }}</x-badge>
                            </div>

                            <!-- Title & Division -->
                            <h2 class="text-2xl font-bold text-ink mb-1">{{ $team->team_name }}</h2>
                            <p class="text-xs font-bold text-primary uppercase tracking-wider mb-4">{{ $team->krti_division }}</p>
                            @if ($team->tagline)
                                <p class="text-xs italic text-body mb-4">&ldquo;{{ $team->tagline }}&rdquo;</p>
                            @endif

                            <p class="text-sm text-body leading-relaxed mb-6">{{ $team->description }}</p>
                        </div>

                        <div class="pt-4 border-t border-line flex justify-end">
                            <a href="{{ route('teams.show', $team->slug) }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white text-sm font-bold rounded hover:bg-primary-dark transition-colors">
                                Lihat Misi &amp; Spesifikasi &rarr;
                            </a>
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
</x-layout.app>
