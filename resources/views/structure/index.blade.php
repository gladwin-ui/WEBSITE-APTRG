<x-layout.app title="Struktur Kepengurusan">
    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Struktur Kepengurusan</h1>
            <p class="text-body mt-2">Bagan organisasi hierarkis Laboratorium APTRG Telkom University.</p>
        </div>
    </section>

    <!-- ORG CHART SECTION -->
    <section class="py-16 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- DESKTOP ORG CHART TREE (>= lg) -->
            <div class="hidden lg:block">
                <!-- Baris 1: Kapten (Level 1) -->
                <div class="flex flex-col items-center">
                    @foreach ($membersByLevel[1] ?? [] as $m)
                        <x-org-node :member="$m" />
                    @endforeach
                    <!-- Garis penghubung vertikal ke bawah -->
                    <div class="h-10 w-0.5 bg-primary"></div>
                </div>

                <!-- Horizontal Connector Baris 2 -->
                <div class="max-w-4xl mx-auto border-t-2 border-primary relative h-8">
                    <!-- Garis turun ke kiri (Wakil Internal) -->
                    <div class="absolute left-1/4 top-0 h-8 w-0.5 bg-primary -translate-x-1/2"></div>
                    <!-- Garis turun ke kanan (Wakil Eksternal) -->
                    <div class="absolute left-3/4 top-0 h-8 w-0.5 bg-primary -translate-x-1/2"></div>
                </div>

                <!-- Baris 2: Wakil Kapten Internal & Eksternal (Level 2) -->
                <div class="max-w-5xl mx-auto grid grid-cols-2 gap-12">
                    @foreach ($membersByLevel[2] ?? [] as $m)
                        <div class="flex flex-col items-center">
                            <x-org-node :member="$m" />
                            <!-- Garis penghubung vertikal dari masing-masing Wakil -->
                            <div class="h-10 w-0.5 bg-primary"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Baris 3: Sekretaris & Bendahara (Level 3) - di bawah Wakil Internal -->
                <div class="max-w-5xl mx-auto grid grid-cols-2 gap-12 mb-12">
                    <!-- Kolom Kiri: Sekretaris & Bendahara -->
                    <div>
                        <div class="max-w-md mx-auto border-t-2 border-primary relative h-8">
                            <div class="absolute left-1/4 top-0 h-8 w-0.5 bg-primary -translate-x-1/2"></div>
                            <div class="absolute left-3/4 top-0 h-8 w-0.5 bg-primary -translate-x-1/2"></div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($membersByLevel[3] ?? [] as $m)
                                <x-org-node :member="$m" />
                            @endforeach
                        </div>
                    </div>
                    <!-- Kolom Kanan: Garis terusan dari Wakil Eksternal ke 4 Koordinator -->
                    <div class="flex flex-col items-center justify-center">
                        <div class="h-full w-0.5 bg-primary"></div>
                    </div>
                </div>

                <!-- Baris 4: 4 Koordinator Divisi (Level 4) -->
                <div class="pt-6 border-t-2 border-primary max-w-6xl mx-auto relative">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-full h-6 w-0.5 bg-primary"></div>
                    <div class="grid grid-cols-4 gap-6 pt-8">
                        @foreach ($membersByLevel[4] ?? [] as $m)
                            <div class="flex flex-col items-center">
                                <div class="h-8 w-0.5 bg-primary -mt-8 mb-4"></div>
                                <x-org-node :member="$m" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- MOBILE / TABLET HIERARCHICAL TREE (< lg) -->
            <div class="lg:hidden space-y-6 max-w-md mx-auto">
                <!-- Level 1: Kapten -->
                @if (!empty($membersByLevel[1]))
                    <div class="space-y-4">
                        @foreach ($membersByLevel[1] as $m)
                            <div class="bg-surface border-2 border-primary rounded-2xl p-6 text-center shadow-md">
                                <img src="{{ asset($m->photo_path ?: 'images/avatar-placeholder.svg') }}"
                                     alt="{{ $m->name }}"
                                     class="w-24 h-24 rounded-full object-cover object-top border-4 border-primary mx-auto mb-4 shadow-sm">
                                <h4 class="font-extrabold text-ink text-lg">{{ $m->name }}</h4>
                                <p class="text-sm font-bold text-primary uppercase tracking-wide mt-1">{{ $m->position }}</p>
                                <p class="text-xs text-body mt-2 border-t border-line pt-2">{{ $m->study_program }} &bull; Angkatan {{ $m->batch }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- Garis Penghubung -->
                    <div class="h-8 w-0.5 bg-primary mx-auto"></div>
                @endif

                <!-- Level 2: Wakil Kapten -->
                @if (!empty($membersByLevel[2]))
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            Wakil Kapten
                        </span>
                    </div>
                    <div class="space-y-4">
                        @foreach ($membersByLevel[2] as $m)
                            <div class="bg-surface border border-line border-l-4 border-l-primary rounded-xl p-4 flex items-center space-x-4 shadow-sm hover:border-primary transition-colors">
                                <img src="{{ asset($m->photo_path ?: 'images/avatar-placeholder.svg') }}"
                                     alt="{{ $m->name }}"
                                     class="w-16 h-16 rounded-full object-cover object-top border-2 border-primary flex-shrink-0 shadow-sm">
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-ink text-base leading-snug">{{ $m->name }}</h4>
                                    <p class="text-xs font-bold text-primary uppercase tracking-wider mt-0.5">{{ $m->position }}</p>
                                    <p class="text-xs text-body mt-1 truncate">{{ $m->study_program }} &bull; {{ $m->batch }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Garis Penghubung -->
                    <div class="h-8 w-0.5 bg-primary mx-auto"></div>
                @endif

                <!-- Level 3: Sekretaris & Bendahara -->
                @if (!empty($membersByLevel[3]))
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            Sekretaris &amp; Bendahara
                        </span>
                    </div>
                    <div class="space-y-4">
                        @foreach ($membersByLevel[3] as $m)
                            <div class="bg-surface border border-line border-l-4 border-l-primary rounded-xl p-4 flex items-center space-x-4 shadow-sm hover:border-primary transition-colors">
                                <img src="{{ asset($m->photo_path ?: 'images/avatar-placeholder.svg') }}"
                                     alt="{{ $m->name }}"
                                     class="w-16 h-16 rounded-full object-cover object-top border-2 border-primary flex-shrink-0 shadow-sm">
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-ink text-base leading-snug">{{ $m->name }}</h4>
                                    <p class="text-xs font-bold text-primary uppercase tracking-wider mt-0.5">{{ $m->position }}</p>
                                    <p class="text-xs text-body mt-1 truncate">{{ $m->study_program }} &bull; {{ $m->batch }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Garis Penghubung -->
                    <div class="h-8 w-0.5 bg-primary mx-auto"></div>
                @endif

                <!-- Level 4: Koordinator Divisi -->
                @if (!empty($membersByLevel[4]))
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                            Koordinator Divisi
                        </span>
                    </div>
                    <div class="space-y-4">
                        @foreach ($membersByLevel[4] as $m)
                            <div class="bg-surface border border-line border-l-4 border-l-primary rounded-xl p-4 flex items-center space-x-4 shadow-sm hover:border-primary transition-colors">
                                <img src="{{ asset($m->photo_path ?: 'images/avatar-placeholder.svg') }}"
                                     alt="{{ $m->name }}"
                                     class="w-16 h-16 rounded-full object-cover object-top border-2 border-primary flex-shrink-0 shadow-sm">
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-ink text-base leading-snug">{{ $m->name }}</h4>
                                    <p class="text-xs font-bold text-primary uppercase tracking-wider mt-0.5">{{ $m->position }}</p>
                                    <p class="text-xs text-body mt-1 truncate">{{ $m->study_program }} &bull; {{ $m->batch }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout.app>
