<footer class="bg-ink text-white border-t border-line mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Brand Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-aptrg.png') }}" alt="APTRG Logo" class="h-10 w-10 rounded-full object-contain bg-white p-0.5">
                    <div>
                        <span class="text-lg font-bold tracking-tight text-white">APTRG</span>
                        <span class="block text-xs font-medium text-line">Telkom University</span>
                    </div>
                </div>
                <p class="text-sm text-line leading-relaxed">
                    Aeromodelling and Payload Telemetry Research Group (APTRG) — Laboratorium riset di bawah naungan Fakultas Teknik Elektro, Telkom University, Bandung.
                </p>
                <p class="text-sm font-semibold text-primary">
                    "Fight Together, Win Together, Yes We Can"
                </p>
            </div>

            <!-- Navigasi Cepat -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4 border-b-2 border-primary inline-block pb-1">
                    Navigasi Cepat
                </h3>
                <ul class="space-y-2 text-sm text-line">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profile') }}" class="hover:text-white transition-colors">Profil & Visi Misi</a></li>
                    <li><a href="{{ route('divisions.index') }}" class="hover:text-white transition-colors">Divisi Internal</a></li>
                    <li><a href="{{ route('teams.index') }}" class="hover:text-white transition-colors">Tim Lomba KRTI</a></li>
                    <li><a href="{{ route('achievements.index') }}" class="hover:text-white transition-colors">Prestasi Lab</a></li>
                    <li><a href="{{ route('structure') }}" class="hover:text-white transition-colors">Struktur Kepengurusan</a></li>
                </ul>
            </div>

            <!-- Kontak & Sosial Media -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-wider text-white mb-4 border-b-2 border-primary inline-block pb-1">
                    Kontak & Lokasi
                </h3>
                <div class="space-y-3 text-sm text-line">
                    <p>
                        Fakultas Teknik Elektro, Telkom University<br>
                        Jl. Telekomunikasi No. 1, Bojongsoang, Bandung 40257
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="font-semibold text-white">Instagram:</span>
                        <a href="https://instagram.com/aptrg" target="_blank" class="hover:text-primary transition-colors">@aptrg</a>
                    </p>
                    <p class="flex items-center space-x-2">
                        <span class="font-semibold text-white">Email:</span>
                        <span>info@aptrg.telkomuniversity.ac.id</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-body/30 text-center text-xs text-line">
            <p>&copy; {{ date('Y') }} Laboratorium APTRG Telkom University. All rights reserved.</p>
        </div>
    </div>
</footer>
