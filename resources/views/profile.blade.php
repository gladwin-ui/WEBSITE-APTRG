<x-layout.app title="Profil & Visi Misi">
    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Profil Laboratorium</h1>
            <p class="text-body mt-2">Mengenal lebih dekat sejarah, visi, misi, dan fokus riset kedirgantaraan APTRG.</p>
        </div>
    </section>

    <!-- ABOUT LAB -->
    <section class="py-16 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 space-y-6">
                    <x-section-heading title="Sejarah &amp; Dedikasi APTRG" subtitle="Berdiri sejak tahun {{ $profile->founded_year }}, menjadi pelopor teknologi wahana terbang tanpa awak di Telkom University." />
                    @foreach (explode("\n\n", $profile->about) as $p)
                        <p class="text-body leading-relaxed">{{ $p }}</p>
                    @endforeach
                </div>
                <div>
                    <div class="bg-surface border border-line p-6 rounded-lg space-y-4">
                        <img src="{{ asset($profile->logo_path) }}" alt="APTRG Logo" class="w-36 h-36 mx-auto rounded-full">
                        <div class="text-center">
                            <h3 class="font-bold text-ink text-lg">{{ $profile->name }}</h3>
                            <p class="text-xs font-semibold text-primary uppercase mt-1">{{ $profile->abbreviation }}</p>
                        </div>
                        <div class="border-t border-line pt-4 space-y-2 text-sm text-body">
                            <p><strong>Fakultas:</strong> {{ $profile->faculty }}</p>
                            <p><strong>Tahun Berdiri:</strong> {{ $profile->founded_year }}</p>
                            <p><strong>Tagline:</strong> "{{ $profile->tagline }}"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="py-16 bg-surface border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Visi -->
                <div>
                    <x-section-heading title="Visi Laboratorium" />
                    <div class="bg-primary-light border-l-4 border-primary p-6 rounded-r-lg">
                        <p class="text-lg font-semibold text-ink leading-relaxed">
                            &ldquo;{{ $profile->vision }}&rdquo;
                        </p>
                    </div>
                </div>

                <!-- Misi -->
                <div>
                    <x-section-heading title="Misi Laboratorium" />
                    <ul class="space-y-4">
                        @foreach ($profile->mission as $misi)
                            <li class="flex items-start space-x-3">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-primary text-white font-bold text-xs flex items-center justify-center mt-0.5">
                                    {{ $loop->iteration }}
                                </span>
                                <span class="text-body leading-relaxed">{{ $misi }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FOKUS RISET -->
    <section class="py-16 bg-canvas border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Fokus Riset Utama" subtitle="Bidang spesialisasi riset multidisiplin yang dikembangkan di Laboratorium APTRG." :centered="true" />

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @foreach ($profile->research_focus as $focus)
                    <x-card class="p-6 text-center hover:border-primary transition-colors">
                        <div class="w-12 h-12 rounded-full bg-primary text-white font-bold flex items-center justify-center mx-auto mb-4">
                            #{{ $loop->iteration }}
                        </div>
                        <h3 class="text-lg font-bold text-ink">{{ $focus }}</h3>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>

    <!-- LOKASI & KONTAK -->
    <section class="py-16 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading title="Lokasi &amp; Kontak" />
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-card class="p-6">
                    <h4 class="font-bold text-ink mb-2">Alamat Laboratorium</h4>
                    <p class="text-sm text-body leading-relaxed">{{ $profile->address }}</p>
                </x-card>
                <x-card class="p-6">
                    <h4 class="font-bold text-ink mb-2">Email Resmi</h4>
                    <p class="text-sm text-body leading-relaxed">{{ $profile->email }}</p>
                </x-card>
                <x-card class="p-6">
                    <h4 class="font-bold text-ink mb-2">Instagram Resmi</h4>
                    <p class="text-sm text-body leading-relaxed">
                        <a href="https://instagram.com/aptrg" target="_blank" class="text-primary font-bold hover:underline">
                            {{ $profile->instagram }}
                        </a>
                    </p>
                </x-card>
            </div>
        </div>
    </section>
</x-layout.app>
