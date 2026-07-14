<x-layout.app :title="$division->name">
    <!-- BREADCRUMB & HEADER DENGAN FOTO -->
    <section class="bg-surface border-b border-line py-10 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Navigasi Back / Breadcrumb di Pinggir Kiri -->
            <div class="flex justify-start mb-6">
                <a href="{{ route('divisions.index') }}" class="inline-flex items-center gap-2.5 px-4 py-2 bg-canvas border border-line rounded-lg text-xs font-bold uppercase tracking-wider text-ink hover:text-primary hover:border-primary transition-all shadow-sm">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Divisi &bull; {{ $division->name }}</span>
                </a>
            </div>

            <!-- Judul Divisi Rata Tengah -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-ink uppercase tracking-tight text-center">
                {{ $division->name }}
            </h1>

            <!-- Foto Header Divisi -->
            @php
                $headerImage = match($division->slug) {
                    'mekanik' => asset('images/foto-mekanik.jpg'),
                    'sistem' => asset('images/foto-sistem.jpg'),
                    'non-technical' => asset('images/foto-nontech.jpg'),
                    default => asset('images/bg-hero-1.jpg'),
                };
            @endphp
            <div class="mt-8 overflow-hidden rounded-xl border border-line shadow-sm bg-canvas">
                <img src="{{ $headerImage }}" 
                     alt="Foto Header {{ $division->name }}" 
                     class="w-full h-96 sm:h-[32rem] object-cover object-[50%_65%]">
            </div>
        </div>
    </section>

    <!-- DETAIL CONTENT (VERTIKAL DARI ATAS KE BAWAH) -->
    <section class="py-16 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- 1. KOORDINATOR DIVISI -->
            <x-card class="p-8 sm:p-10 text-center">
                <h3 class="text-xs font-bold uppercase tracking-wider text-primary pb-3 border-b border-line mb-8">
                    Koordinator Divisi
                </h3>
                @forelse ($members as $member)
                    <div class="flex flex-col items-center justify-center gap-6">
                        <img src="{{ asset($member->photo_path ?: 'images/avatar-placeholder.svg') }}" 
                             alt="{{ $member->name }}" 
                             class="w-48 h-48 sm:w-56 sm:h-56 rounded-full object-cover object-top border-4 border-primary shadow-md mx-auto">
                        <div class="space-y-2">
                            <h4 class="text-2xl sm:text-3xl font-extrabold text-ink">{{ $member->name }}</h4>
                            <p class="text-base font-bold text-primary uppercase tracking-wide">{{ $member->position }}</p>
                            <p class="text-sm sm:text-base text-body pt-1">
                                {{ $member->study_program }} &bull; Angkatan {{ $member->batch }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-body text-center py-4">Belum ada data koordinator.</p>
                @endforelse
            </x-card>

            <!-- 2. DESKRIPSI DIVISI -->
            <x-card class="p-8">
                <x-section-heading title="Deskripsi Divisi" />
                <p class="text-body leading-relaxed text-base sm:text-lg">
                    {{ $division->description }}
                </p>
            </x-card>

            <!-- 3. JOBDESK / TANGGUNG JAWAB UTAMA -->
            <x-card class="p-8">
                <x-section-heading title="Daftar Tanggung Jawab Utama" />
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    @foreach ($division->responsibilities as $resp)
                        <li class="flex items-start space-x-3 bg-canvas border border-line p-4 rounded-lg">
                            <span class="flex-shrink-0 w-6 h-6 rounded bg-primary text-white font-bold text-xs flex items-center justify-center mt-0.5">
                                &checkmark;
                            </span>
                            <span class="text-body font-medium leading-relaxed">{{ $resp }}</span>
                        </li>
                    @endforeach
                </ul>
            </x-card>

            <!-- 4. FOTO KEGIATAN DIVISI -->
            <x-card class="p-8">
                <x-section-heading title="Dokumentasi & Kegiatan Divisi" subtitle="Potret aktivitas riset, perancangan, dan eksperimen yang dilakukan oleh {{ $division->name }}." />
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-6">
                    <div class="group relative overflow-hidden rounded-lg border border-line bg-canvas">
                        <img src="{{ asset('images/bg-hero-1.jpg') }}" alt="Kegiatan {{ $division->name }} 1" class="w-full h-80 sm:h-96 object-cover object-top transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 bg-ink/80 p-4 text-white text-sm font-semibold">
                            Aktivitas Riset &amp; Pengembangan Divisi
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg border border-line bg-canvas">
                        <img src="{{ asset('images/bg-hero-2.jpg') }}" alt="Kegiatan {{ $division->name }} 2" class="w-full h-80 sm:h-96 object-cover object-top transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 bg-ink/80 p-4 text-white text-sm font-semibold">
                            Pengujian &amp; Perakitan Wahana
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg border border-line bg-canvas">
                        <img src="{{ asset('images/bg-hero-1.jpg') }}" alt="Kegiatan {{ $division->name }} 3" class="w-full h-80 sm:h-96 object-cover object-top transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 bg-ink/80 p-4 text-white text-sm font-semibold">
                            Diskusi Teknis &amp; Koordinasi Tim
                        </div>
                    </div>
                    <div class="group relative overflow-hidden rounded-lg border border-line bg-canvas">
                        <img src="{{ asset('images/bg-hero-2.jpg') }}" alt="Kegiatan {{ $division->name }} 4" class="w-full h-80 sm:h-96 object-cover object-top transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-x-0 bottom-0 bg-ink/80 p-4 text-white text-sm font-semibold">
                            Kolaborasi Lintas Divisi APTRG
                        </div>
                    </div>
                </div>
            </x-card>

            <!-- 5. TOMBOL KEMBALI -->
            <div class="text-center pt-2">
                <a href="{{ route('divisions.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-surface border border-line text-xs font-bold uppercase tracking-wider text-primary rounded-lg shadow-sm hover:border-primary transition-colors">
                    &larr; Kembali ke Daftar Divisi
                </a>
            </div>

        </div>
    </section>
</x-layout.app>
