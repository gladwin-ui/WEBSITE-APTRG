<x-layout.app title="Prestasi Laboratorium">
    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Prestasi Laboratorium</h1>
            <p class="text-body mt-2">Daftar penghargaan dan pencapaian kebanggaan APTRG di tingkat Nasional maupun Internasional.</p>
        </div>
    </section>

    <!-- ACHIEVEMENTS LIST + ALPINE CLIENT-SIDE FILTER -->
    <section class="py-16 bg-canvas"
             x-data="{
                 selectedYear: 'all',
                 selectedCompetition: 'all',
                 achievements: {{ json_encode($achievements->map(function ($ach) {
                     return [
                         'id' => $ach->id,
                         'title' => $ach->title,
                         'competition' => $ach->competition,
                         'year' => (string) $ach->year,
                         'rank' => $ach->rank,
                         'category' => $ach->category,
                         'level' => $ach->level,
                         'team_name' => $ach->competitionTeam?->team_name ?? 'Tim APTRG',
                         'description' => $ach->description,
                     ];
                 })) }},
                 matchesFilter(item) {
                     const matchYear = (this.selectedYear === 'all' || item.year === this.selectedYear);
                     const matchComp = (this.selectedCompetition === 'all' || item.competition === this.selectedCompetition);
                     return matchYear && matchComp;
                 }
             }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- FILTER TOOLBAR (Alpine Client-Side) -->
            <div class="bg-surface border border-line p-6 rounded-lg mb-10 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Filter Tahun -->
                        <div>
                            <label for="yearFilter" class="block text-xs font-bold uppercase tracking-wider text-body mb-1">Filter Tahun</label>
                            <select id="yearFilter" x-model="selectedYear" class="border border-line rounded px-3 py-2 text-sm font-semibold text-ink bg-surface focus:outline-none focus:border-primary">
                                <option value="all">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Kompetisi -->
                        <div>
                            <label for="compFilter" class="block text-xs font-bold uppercase tracking-wider text-body mb-1">Filter Kompetisi</label>
                            <select id="compFilter" x-model="selectedCompetition" class="border border-line rounded px-3 py-2 text-sm font-semibold text-ink bg-surface focus:outline-none focus:border-primary">
                                <option value="all">Semua Kompetisi</option>
                                @foreach ($competitions as $comp)
                                    <option value="{{ $comp }}">{{ $comp }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <div class="pt-2 sm:pt-0">
                        <button type="button"
                                @click="selectedYear = 'all'; selectedCompetition = 'all'"
                                class="px-4 py-2 border border-line text-xs font-bold uppercase tracking-wider text-body hover:bg-primary hover:text-white hover:border-primary rounded transition-colors">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- TIMELINE LIST -->
            <div class="space-y-6">
                <template x-for="ach in achievements" :key="ach.id">
                    <div x-show="matchesFilter(ach)"
                         x-transition
                         class="bg-surface border border-line rounded-lg p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 hover:border-primary transition-colors">
                        <div class="space-y-2 max-w-3xl">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="bg-primary text-white text-xs font-bold px-2.5 py-0.5 rounded" x-text="ach.year"></span>
                                <span class="bg-canvas text-ink border border-line text-xs font-bold px-2.5 py-0.5 rounded" x-text="ach.competition"></span>
                                <span class="text-xs font-bold uppercase text-body" x-text="ach.level"></span>
                            </div>
                            <h3 class="text-xl font-bold text-ink" x-text="ach.title"></h3>
                            <p class="text-sm font-semibold text-primary" x-text="ach.rank + ' • ' + ach.category"></p>
                            <p class="text-sm text-body leading-relaxed" x-text="ach.description"></p>
                        </div>
                        <div class="md:text-right flex-shrink-0">
                            <span class="inline-block bg-primary-light text-primary text-xs font-bold px-3 py-1.5 rounded" x-text="ach.team_name"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
</x-layout.app>
