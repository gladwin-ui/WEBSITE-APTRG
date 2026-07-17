<x-layout.app title="Tim Lomba">
    @php
        // Palet warna gradient per tim (menggunakan gradasi merah muda ke merah tua)
        $palettes = [
            'frigate'   => ['#E23744', '#7A0C14'],
            'bangau'    => ['#E23744', '#7A0C14'],
            'raven'     => ['#E23744', '#7A0C14'],
            'strix'     => ['#E23744', '#7A0C14'],
            'avalerion' => ['#E23744', '#7A0C14'],
        ];
        $fallback = ['#E23744', '#7A0C14'];
        // Hero cutout transparan hasil olahan (fallback ke logo bila belum ada)
        $heroSrc = function ($team) {
            $p = public_path("images/hero-{$team->slug}.png");
            return file_exists($p) ? "images/hero-{$team->slug}.png" : $team->logo_path;
        };
        $teamsList = $teams->values();
    @endphp

    <!-- PAGE HEADER -->
    <section class="bg-surface border-b border-line py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-ink">Tim Lomba APTRG</h1>
            <p class="text-body mt-2">Lima tim wahana terbang otonom yang mewakili Telkom University pada kompetisi nasional dan internasional seperti KRTI dan TEKNOFEST.</p>
        </div>
    </section>

    <!-- TEAMS CARD CAROUSEL -->
    <section class="tc-section">
        <div
            x-data="{
                open: null,
                total: {{ $teamsList->count() }},
                openCard(i) { this.open = i; document.body.style.overflow = 'hidden'; },
                close() { this.open = null; document.body.style.overflow = ''; },
                go(dir) { this.open = (this.open + dir + this.total) % this.total; },
                scroll(dir) {
                    const t = this.$refs.track;
                    t.scrollBy({ left: dir * (t.clientWidth * 0.7), behavior: 'smooth' });
                }
            }"
            x-cloak
            @keydown.escape.window="close()"
            class="tc-wrap">

            {{-- ======================= ROW OF CARDS ======================= --}}
            <div class="tc-track" x-ref="track" role="list">
                @foreach ($teamsList as $team)
                    @php
                        $i = $loop->index;
                        [$c1, $c2] = $palettes[$team->slug] ?? $fallback;
                    @endphp
                    <button
                        type="button"
                        role="listitem"
                        class="tc-card"
                        style="--c1: {{ $c1 }}; --c2: {{ $c2 }};"
                        @click="openCard({{ $i }})"
                        aria-label="Lihat detail {{ $team->team_name }}">

                        <div class="tc-card__glow"></div>

                        {{-- Hero (maskot) yang menyembul ke atas kartu --}}
                        <img
                            src="{{ asset($heroSrc($team)) }}"
                            alt="{{ $team->team_name }}"
                            loading="lazy" decoding="async"
                            class="tc-card__hero">

                        {{-- Konten bawah kartu --}}
                        <div class="tc-card__body">
                            <h3 class="tc-card__name">{{ $team->team_name }}</h3>
                            <p class="tc-card__meta">
                                <span class="tc-card__meta-key">{{ $team->krti_code }}</span>
                                {{ $team->krti_division }}
                            </p>
                            <span class="tc-card__more">Lihat Detail
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </button>
                @endforeach
            </div>

            {{-- ======================= CAROUSEL NAV ======================= --}}
            <div class="tc-nav">
                <button type="button" class="tc-nav__btn" @click="scroll(-1)" aria-label="Sebelumnya">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    <span>Prev</span>
                </button>
                <button type="button" class="tc-nav__btn" @click="scroll(1)" aria-label="Berikutnya">
                    <span>Next</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- ======================= DETAIL OVERLAY ======================= --}}
            <div class="tc-overlay"
                 x-show="open !== null"
                 x-transition.opacity.duration.300ms
                 @click.self="close()"
                 style="display:none;">

                @foreach ($teamsList as $team)
                    @php
                        $i = $loop->index;
                        [$c1, $c2] = $palettes[$team->slug] ?? $fallback;
                        $specs = collect($team->specs ?? [])->take(4);
                    @endphp
                    <div class="tc-detail"
                         x-show="open === {{ $i }}"
                         x-transition:enter="tc-anim-in"
                         style="--c1: {{ $c1 }}; --c2: {{ $c2 }}; display:none;">

                        {{-- Rail navigasi antar tim --}}
                        <div class="tc-detail__rail">
                            <button type="button" class="tc-rail__chev" @click="go(-1)" aria-label="Tim sebelumnya">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 15l-6-6-6 6"/></svg>
                            </button>
                            <span class="tc-rail__label">{{ $team->team_name }}</span>
                            <button type="button" class="tc-rail__chev" @click="go(1)" aria-label="Tim berikutnya">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/></svg>
                            </button>
                        </div>

                        {{-- Panel utama --}}
                        <div class="tc-detail__panel">
                            <button type="button" class="tc-detail__close" @click="close()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/></svg>
                                Tutup
                            </button>

                            <div class="tc-detail__grid">
                                {{-- Sisi kiri: hero besar --}}
                                <div class="tc-detail__hero-wrap">
                                    <img src="{{ asset($heroSrc($team)) }}" alt="{{ $team->team_name }}" class="tc-detail__hero">
                                </div>

                                {{-- Sisi kanan: konten --}}
                                <div class="tc-detail__content">
                                    <h2 class="tc-detail__name">{{ $team->team_name }}</h2>
                                    <p class="tc-detail__meta">
                                        <span class="tc-detail__badge">{{ $team->krti_code }}</span>
                                        {{ $team->krti_division }} &bull; {{ $team->aircraft_type }}
                                    </p>

                                    @if ($team->tagline)
                                        <p class="tc-detail__tagline">&ldquo;{{ $team->tagline }}&rdquo;</p>
                                    @endif

                                    <p class="tc-detail__desc">{{ $team->description }}</p>

                                    @if ($specs->isNotEmpty())
                                        <p class="tc-detail__specs-title">Spesifikasi Wahana</p>
                                        <div class="tc-detail__chips">
                                            @foreach ($specs as $key => $value)
                                                <div class="tc-chip">
                                                    <span class="tc-chip__k">{{ $key }}</span>
                                                    <span class="tc-chip__v">{{ $value }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <a href="{{ route('teams.show', $team->slug) }}" class="tc-detail__cta">
                                        Lihat Misi &amp; Spesifikasi Lengkap
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
    <style>
        /* ===================== SECTION ===================== */
        .tc-section { padding: 3.5rem 0 4.5rem; background: #F7F7F7; overflow: hidden; }
        .tc-wrap { max-width: 80rem; margin: 0 auto; padding: 0 1rem; }

        /* ===================== CARD TRACK ===================== */
        .tc-track {
            display: flex;
            gap: 1.75rem;
            padding: 5.5rem 0.5rem 2rem;   /* ruang atas untuk hero yang menyembul */
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
        }
        .tc-track::-webkit-scrollbar { display: none; }

        /* ===================== CARD ===================== */
        .tc-card {
            position: relative;
            flex: 0 0 auto;
            width: 15.5rem;
            height: 18rem;
            border-radius: 1.5rem;
            border: none;
            cursor: pointer;
            scroll-snap-align: start;
            text-align: left;
            background: linear-gradient(160deg, var(--c1), var(--c2));
            box-shadow: 0 18px 35px -18px color-mix(in srgb, var(--c2) 80%, transparent);
            transition: transform .45s cubic-bezier(.22,1,.36,1), box-shadow .45s ease;
            overflow: visible;
        }
        .tc-card:hover {
            transform: translateY(-14px);
            box-shadow: 0 40px 60px -22px color-mix(in srgb, var(--c1) 75%, transparent);
        }
        .tc-card__glow {
            position: absolute; inset: 0;
            border-radius: inherit;
            background: radial-gradient(120% 80% at 50% 0%, rgba(255,255,255,.28), transparent 60%);
            opacity: .7;
        }

        /* Hero logo menyembul di atas kartu */
        .tc-card__hero {
            position: absolute;
            left: 50%;
            top: -4.5rem;
            transform: translateX(-50%);
            width: 11rem;
            height: 12.5rem;
            object-fit: contain;
            filter: drop-shadow(0 22px 22px rgba(0,0,0,.35));
            transition: transform .45s cubic-bezier(.22,1,.36,1);
            pointer-events: none;
        }
        .tc-card:hover .tc-card__hero {
            transform: translateX(-50%) translateY(-16px) scale(1.06);
        }

        .tc-card__body {
            position: absolute;
            inset: auto 0 0 0;
            padding: 1.25rem 1.25rem 1.35rem;
            color: #fff;
        }
        .tc-card__name {
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -.01em;
            text-shadow: 0 2px 10px rgba(0,0,0,.25);
        }
        .tc-card__meta {
            margin-top: .35rem;
            font-size: .8rem;
            font-weight: 500;
            color: rgba(255,255,255,.82);
            display: flex; align-items: center; gap: .4rem;
        }
        .tc-card__meta-key {
            font-size: .62rem; font-weight: 800; letter-spacing: .08em;
            text-transform: uppercase;
            background: rgba(255,255,255,.22);
            padding: .12rem .45rem; border-radius: .3rem;
        }
        .tc-card__more {
            display: inline-flex; align-items: center; gap: .3rem;
            margin-top: .7rem;
            font-size: .72rem; font-weight: 800; letter-spacing: .06em;
            text-transform: uppercase;
            color: #fff;
            opacity: 0; transform: translateY(6px);
            transition: opacity .35s ease, transform .35s ease;
        }
        .tc-card__more svg { width: .85rem; height: .85rem; }
        .tc-card:hover .tc-card__more { opacity: 1; transform: translateY(0); }

        /* ===================== CAROUSEL NAV ===================== */
        .tc-nav {
            display: flex; justify-content: flex-end; gap: .75rem;
            margin-top: .5rem; padding-right: .5rem;
        }
        .tc-nav__btn {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .5rem .95rem;
            font-size: .8rem; font-weight: 700; color: #4B4B4B;
            background: #fff; border: 1px solid #E5E5E5; border-radius: 999px;
            cursor: pointer; transition: all .25s ease;
        }
        .tc-nav__btn:hover { color: #C1121F; border-color: #C1121F; transform: translateY(-1px); }
        .tc-nav__btn svg { width: 1rem; height: 1rem; }

        /* ===================== DETAIL OVERLAY ===================== */
        .tc-overlay {
            position: fixed; inset: 0; z-index: 60;
            display: flex; align-items: center; justify-content: center;
            padding: 1.25rem;
            background: rgba(17,17,17,.55);
            backdrop-filter: blur(6px);
        }
        .tc-detail {
            display: flex; align-items: stretch; gap: .5rem;
            width: 100%; max-width: 60rem;
        }
        .tc-anim-in { animation: tcPop .5s cubic-bezier(.22,1,.36,1); }
        @keyframes tcPop {
            from { opacity: 0; transform: translateY(24px) scale(.94); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Rail navigasi */
        .tc-detail__rail {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; gap: 1rem;
            flex: 0 0 auto;
        }
        .tc-rail__chev {
            display: grid; place-items: center;
            width: 2.4rem; height: 2.4rem;
            border-radius: 999px; cursor: pointer;
            color: #fff; background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.25);
            transition: all .2s ease;
        }
        .tc-rail__chev:hover { background: rgba(255,255,255,.28); transform: scale(1.08); }
        .tc-rail__chev svg { width: 1.2rem; height: 1.2rem; }
        .tc-rail__label {
            writing-mode: vertical-rl; transform: rotate(180deg);
            font-size: .7rem; font-weight: 700; letter-spacing: .12em;
            text-transform: uppercase; color: rgba(255,255,255,.75);
        }

        /* Panel */
        .tc-detail__panel {
            position: relative; flex: 1 1 auto;
            border-radius: 1.75rem; overflow: hidden;
            background: linear-gradient(150deg, var(--c1), var(--c2));
            box-shadow: 0 40px 80px -20px rgba(0,0,0,.55);
        }
        .tc-detail__close {
            position: absolute; top: 1rem; right: 1.15rem; z-index: 3;
            display: inline-flex; align-items: center; gap: .35rem;
            font-size: .75rem; font-weight: 700; color: #fff;
            background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.25);
            padding: .4rem .75rem; border-radius: 999px; cursor: pointer;
            transition: background .2s ease;
        }
        .tc-detail__close:hover { background: rgba(255,255,255,.3); }
        .tc-detail__close svg { width: .95rem; height: .95rem; }

        .tc-detail__grid {
            display: grid; grid-template-columns: 40% 60%;
            align-items: center;
            min-height: 26rem;
        }
        .tc-detail__hero-wrap {
            position: relative; height: 100%;
            display: grid; place-items: center;
            padding: 2rem;
        }
        .tc-detail__hero-wrap::before {
            content: ''; position: absolute; inset: 8% 4%;
            border-radius: 50% 50% 46% 54% / 55% 55% 45% 45%;
            background: rgba(255,255,255,.10);
        }
        .tc-detail__hero {
            position: relative;
            max-width: 100%; max-height: 20rem;
            object-fit: contain;
            filter: drop-shadow(0 26px 30px rgba(0,0,0,.4));
        }
        .tc-detail__content {
            padding: 2.25rem 2.5rem 2.25rem 1rem;
            color: #fff;
        }
        .tc-detail__name { font-size: 2.25rem; font-weight: 800; line-height: 1.05; letter-spacing: -.02em; }
        .tc-detail__meta {
            margin-top: .5rem; display: flex; align-items: center; flex-wrap: wrap; gap: .5rem;
            font-size: .82rem; font-weight: 500; color: rgba(255,255,255,.85);
        }
        .tc-detail__badge {
            font-size: .62rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase;
            background: rgba(255,255,255,.22); padding: .15rem .5rem; border-radius: .3rem;
        }
        .tc-detail__tagline {
            margin-top: 1rem; font-style: italic; font-weight: 600;
            font-size: .9rem; color: #fff;
            border-left: 3px solid rgba(255,255,255,.5); padding-left: .75rem;
        }
        .tc-detail__desc {
            margin-top: 1rem; font-size: .875rem; line-height: 1.65;
            color: rgba(255,255,255,.9);
        }
        .tc-detail__specs-title {
            margin-top: 1.5rem; font-size: .68rem; font-weight: 800;
            letter-spacing: .1em; text-transform: uppercase; color: rgba(255,255,255,.7);
        }
        .tc-detail__chips {
            margin-top: .6rem; display: flex; flex-wrap: wrap; gap: .5rem;
        }
        .tc-chip {
            display: flex; flex-direction: column;
            background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.18);
            border-radius: .6rem; padding: .45rem .7rem;
        }
        .tc-chip__k { font-size: .6rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: rgba(255,255,255,.65); }
        .tc-chip__v { font-size: .85rem; font-weight: 700; color: #fff; }
        .tc-detail__cta {
            display: inline-flex; align-items: center; gap: .45rem;
            margin-top: 1.75rem;
            padding: .7rem 1.25rem; border-radius: 999px;
            font-size: .82rem; font-weight: 800;
            color: var(--c2); background: #fff;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .tc-detail__cta:hover { transform: translateY(-2px); box-shadow: 0 12px 22px -8px rgba(0,0,0,.4); }
        .tc-detail__cta svg { width: 1rem; height: 1rem; }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 768px) {
            .tc-card { width: 13rem; height: 16.5rem; }
            .tc-card__hero { width: 9rem; height: 10.5rem; top: -3.75rem; }
            .tc-detail { flex-direction: column; max-height: 90vh; overflow-y: auto; }
            .tc-detail__rail { flex-direction: row; }
            .tc-rail__label { writing-mode: horizontal-tb; transform: none; }
            .tc-detail__grid { grid-template-columns: 1fr; min-height: 0; }
            .tc-detail__hero-wrap { padding: 2.5rem 2rem 1rem; }
            .tc-detail__hero { max-height: 12rem; }
            .tc-detail__content { padding: 0 1.75rem 2rem; text-align: left; }
            .tc-detail__name { font-size: 1.75rem; }
        }
    </style>
    @endpush
</x-layout.app>
