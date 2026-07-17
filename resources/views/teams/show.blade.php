<x-layout.app :title="$team->team_name">
    <!-- BREADCRUMB & HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-xs font-semibold uppercase tracking-wider text-body mb-3">
                <a href="{{ route('teams.index') }}" class="hover:text-primary">Tim Lomba</a> &bull; <span>{{ $team->team_name }}</span>
            </nav>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset($team->logo_path) }}" alt="{{ $team->team_name }}" class="w-16 h-16 rounded object-contain">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">{{ $team->team_name }}</h1>
                        <p class="text-sm font-bold text-primary uppercase mt-1">{{ $team->krti_division }} ({{ $team->krti_code }})</p>
                    </div>
                </div>
                <div>
                    <x-badge color="red">{{ $team->aircraft_type }}</x-badge>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN DETAIL SECTION -->
    <section class="py-16 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Deskripsi & Tema Misi -->
                <div class="lg:col-span-7 space-y-8">
                    <x-card class="p-8">
                        <x-section-heading title="Deskripsi Tim" />
                        <p class="text-body leading-relaxed text-base mb-6">
                            {{ $team->description }}
                        </p>
                        @if ($team->tagline)
                            <div class="bg-primary-light border-l-4 border-primary p-4 rounded-r text-sm font-bold text-primary">
                                &ldquo;{{ $team->tagline }}&rdquo;
                            </div>
                        @endif
                    </x-card>

                    <x-card class="p-8">
                        <x-section-heading title="Tema & Misi Divisi KRTI" />
                        <p class="text-body leading-relaxed text-base">
                            {{ $team->mission_theme }}
                        </p>
                    </x-card>

                    <!-- Prestasi Tim Ini -->
                    <x-card class="p-8">
                        <x-section-heading title="Prestasi Tim {{ $team->team_name }}" />
                        @if ($team->achievements->count() > 0)
                            <div class="space-y-4">
                                @foreach ($team->achievements as $ach)
                                    <div class="border border-line rounded p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                        <div>
                                            <h4 class="font-bold text-ink">{{ $ach->title }}</h4>
                                            <p class="text-xs text-body mt-1">{{ $ach->category }} &bull; {{ $ach->level }}</p>
                                        </div>
                                        <x-badge color="red">{{ $ach->rank }}</x-badge>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-body">Belum ada data prestasi khusus yang tercatat untuk tim ini.</p>
                        @endif
                    </x-card>
                </div>

                <!-- Spesifikasi & Ilustrasi -->
                <div class="lg:col-span-5 space-y-8">
                    <x-card class="p-8">
                        <x-section-heading title="Spesifikasi Teknis Wahana" />
                        <table class="w-full text-sm text-left border-collapse">
                            <tbody>
                                @foreach ($team->specs as $key => $value)
                                    <tr class="border-b border-line last:border-0">
                                        <th class="py-3 pr-4 font-bold text-ink w-1/2">{{ $key }}</th>
                                        <td class="py-3 text-body font-medium">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-card>

                    <!-- Placeholder UAV Image -->
                    <x-card class="p-4 text-center">
                        <img src="{{ asset($team->image_path ?: 'images/placeholder-uav.svg') }}"
                             alt="{{ $team->team_name }} Aircraft"
                             loading="lazy" decoding="async"
                             class="w-full rounded">
                        <p class="text-xs font-semibold text-body mt-3">Ilustrasi Platform Wahana Terbang {{ $team->team_name }}</p>
                    </x-card>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
