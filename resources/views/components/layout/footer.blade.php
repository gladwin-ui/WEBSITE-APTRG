@props(['fullpage' => false])
<footer class="w-full bg-black text-white pt-16 pb-8 px-6 sm:px-8 {{ ($fullpage || request()->routeIs('home')) ? 'mt-0' : 'mt-20' }}">
    <div class="max-w-5xl mx-auto">

        {{-- Logo + Tagline --}}
        <div class="flex flex-col items-center text-center mb-10">
            <img src="{{ asset('images/logo-aptrg.svg') }}" alt="APTRG Logo" class="h-24 w-24 mb-4 object-contain">
            <h2 class="text-2xl font-black tracking-widest uppercase text-white">APTRG</h2>
            <p class="text-xs text-white/50 mt-1">Aeromodelling and Payload Telemetry Research Group</p>
            <p class="text-sm italic text-primary mt-2">"Fight Together, Win Together, Yes We Can"</p>
        </div>

        {{-- Social Media Icons --}}
        <div class="flex justify-center gap-5 mb-10">
            {{-- Instagram --}}
            <a href="https://www.instagram.com/aptrg/" target="_blank" title="Instagram APTRG"
               class="flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
            </a>
            {{-- YouTube --}}
            <a href="https://www.youtube.com/@APTRGLaboratory" target="_blank" title="YouTube APTRG"
               class="flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                    <path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.108C19.516 3.5 12 3.5 12 3.5s-7.517 0-9.388.555A3.003 3.003 0 00.5 6.163C0 8.07 0 12 0 12s0 3.93.5 5.837a3.003 3.003 0 002.11 2.108c1.871.555 9.388.555 9.388.555s7.516 0 9.388-.555a3.003 3.003 0 002.11-2.108C24 15.93 24 12 24 12s0-3.93-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
            </a>
            {{-- TikTok --}}
            <a href="https://www.tiktok.com/@aptrg_telkomuniversity" target="_blank" title="TikTok APTRG"
               class="flex items-center justify-center w-12 h-12 rounded-full border border-white/20 hover:border-primary hover:bg-primary transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="white">
                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.02 1.59 4.14.99 1.15 2.37 1.91 3.88 2.15v3.62c-1.34-.17-2.61-.73-3.66-1.58-1.07-.86-1.85-2.02-2.28-3.32-.05.88-.04 1.76-.04 2.64v8.32c-.04 1.4-.41 2.81-1.15 3.99-.86 1.39-2.23 2.45-3.83 2.94-1.63.5-3.41.45-5.01-.13-1.62-.59-3-1.8-3.79-3.38-.83-1.62-1.01-3.53-.5-5.26.5-1.68 1.63-3.15 3.19-4.04 1.48-.86 3.25-1.12 4.9-.73 0 1.25.01 2.5 0 3.75-.82-.23-1.72-.15-2.47.24-.76.4-1.32 1.11-1.54 1.94-.21.84-.04 1.75.46 2.44.47.66 1.22 1.09 2.02 1.18.82.1 1.66-.14 2.27-.7.68-.61.98-1.55.97-2.45V.02z"/>
                </svg>
            </a>
        </div>

        {{-- Divider --}}
        <div class="border-t border-white/10 mb-8"></div>

        {{-- Contact Info Row --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 text-center">
            <div>
                <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Telepon</span>
                <span class="text-sm text-white/80">+62 822-1234-5678</span>
            </div>
            <div>
                <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Email</span>
                <span class="text-sm text-white/80">aptrg@telkomuniversity.ac.id</span>
            </div>
            <div>
                <span class="block text-xs uppercase tracking-widest text-white/40 font-bold mb-1">Lokasi</span>
                <span class="text-sm text-white/80">Gedung FTE Lt. 3, Telkom University</span>
            </div>
        </div>

        {{-- Divider --}}
        <div class="border-t border-white/10 mb-6"></div>

        {{-- Bottom Bar --}}
        <div class="flex flex-col items-center gap-4 text-xs text-white/40 sm:flex-row sm:justify-between">
            <span class="text-center">© {{ date('Y') }} APTRG Telkom University. All rights reserved.</span>
            <div class="flex flex-wrap justify-center items-center gap-x-4 gap-y-2">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <a href="{{ route('profile') }}" class="hover:text-white transition-colors">Profil</a>
                <a href="{{ route('divisions.index') }}" class="hover:text-white transition-colors">Divisi</a>
                <a href="{{ route('teams.index') }}" class="hover:text-white transition-colors">Tim Lomba</a>
                <a href="{{ route('achievements.index') }}" class="hover:text-white transition-colors">Prestasi</a>
                <a href="{{ route('structure') }}" class="hover:text-white transition-colors">Struktur</a>
            </div>
        </div>

    </div>
</footer>
