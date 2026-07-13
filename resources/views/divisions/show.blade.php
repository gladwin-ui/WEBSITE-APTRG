<x-layout.app :title="$division->name">
    <!-- BREADCRUMB & HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-xs font-semibold uppercase tracking-wider text-body mb-3">
                <a href="{{ route('divisions.index') }}" class="hover:text-primary">Divisi</a> &bull; <span>{{ $division->name }}</span>
            </nav>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">{{ $division->name }}</h1>
            <p class="text-body mt-2">{{ $division->short_description }}</p>
        </div>
    </section>

    <!-- DETAIL CONTENT -->
    <section class="py-16 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Deskripsi & Tanggung Jawab -->
                <div class="lg:col-span-2 space-y-8">
                    <x-card class="p-8">
                        <x-section-heading title="Deskripsi Divisi" />
                        <p class="text-body leading-relaxed text-base">
                            {{ $division->description }}
                        </p>
                    </x-card>

                    <x-card class="p-8">
                        <x-section-heading title="Daftar Tanggung Jawab Utama" />
                        <ul class="space-y-4">
                            @foreach ($division->responsibilities as $resp)
                                <li class="flex items-start space-x-3">
                                    <span class="flex-shrink-0 w-6 h-6 rounded bg-primary text-white font-bold text-xs flex items-center justify-center mt-0.5">
                                        &checkmark;
                                    </span>
                                    <span class="text-body font-medium leading-relaxed">{{ $resp }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </x-card>
                </div>

                <!-- Koordinator Divisi Sidebar -->
                <div>
                    <div class="bg-surface border border-line p-6 rounded-lg sticky top-28">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-ink pb-3 border-b border-line mb-6">
                            Koordinator Divisi
                        </h3>
                        @forelse ($members as $member)
                            <div class="text-center">
                                <img src="{{ asset($member->photo_path ?: 'images/avatar-placeholder.svg') }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-24 h-24 mx-auto rounded-full object-cover border-2 border-primary mb-4">
                                <h4 class="font-bold text-ink text-base">{{ $member->name }}</h4>
                                <p class="text-xs font-bold text-primary uppercase mt-1">{{ $member->position }}</p>
                                <p class="text-xs text-body mt-2 pt-2 border-t border-line">
                                    {{ $member->study_program }} &bull; Angkatan {{ $member->batch }}
                                </p>
                            </div>
                        @empty
                            <p class="text-sm text-body text-center py-4">Belum ada data koordinator.</p>
                        @endforelse
                        <div class="mt-8 pt-4 border-t border-line text-center">
                            <a href="{{ route('divisions.index') }}" class="text-xs font-bold uppercase tracking-wider text-primary hover:underline">
                                &larr; Kembali ke Daftar Divisi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
