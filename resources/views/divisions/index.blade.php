<x-layout.app title="Divisi Internal Lab">
    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Divisi Internal Laboratorium</h1>
            <p class="text-body mt-2">Empat divisi fungsional penopang riset kedirgantaraan dan keorganisasian APTRG.</p>
        </div>
    </section>

    <!-- DIVISION LIST -->
    <section class="py-16 bg-canvas">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($divisions as $div)
                    <x-card class="p-8 flex flex-col justify-between hover:border-primary transition-colors">
                        <div>
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-14 h-14 rounded-lg bg-primary text-white flex items-center justify-center font-extrabold text-xl">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold text-ink">{{ $div->name }}</h2>
                                    <p class="text-xs font-semibold text-primary uppercase tracking-wider">{{ $div->slug }}</p>
                                </div>
                            </div>
                            <p class="text-body leading-relaxed mb-6">{{ $div->description }}</p>

                            <h4 class="text-xs font-bold uppercase tracking-wider text-ink mb-3">Lingkup Tanggung Jawab:</h4>
                            <ul class="space-y-2 mb-6">
                                @foreach ($div->responsibilities as $resp)
                                    <li class="flex items-start text-sm text-body">
                                        <span class="text-primary mr-2 font-bold">&bull;</span>
                                        <span>{{ $resp }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-line flex justify-end">
                            <a href="{{ route('divisions.show', $div->slug) }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white text-sm font-bold rounded hover:bg-primary-dark transition-colors">
                                Lihat Detail &amp; Koordinator &rarr;
                            </a>
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    </section>
</x-layout.app>
