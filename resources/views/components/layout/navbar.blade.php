@php
    $isHome = request()->routeIs('home');
    $links = [
        ['name' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['name' => 'Profil', 'route' => 'profile', 'active' => request()->routeIs('profile')],
        ['name' => 'Divisi', 'route' => 'divisions.index', 'active' => request()->routeIs('divisions.*')],
        ['name' => 'Tim KRTI', 'route' => 'teams.index', 'active' => request()->routeIs('teams.*')],
        ['name' => 'Prestasi', 'route' => 'achievements.index', 'active' => request()->routeIs('achievements.*')],
        ['name' => 'Struktur', 'route' => 'structure', 'active' => request()->routeIs('structure')],
    ];
@endphp

<nav x-data="{ mobileMenuOpen: false, scrolled: false }"
     @scroll.window="scrolled = (window.pageYOffset > 40)"
     class="{{ $isHome ? 'fixed top-0 inset-x-0' : 'sticky top-0' }} z-50 transition-all duration-300"
     :class="{
         'bg-surface border-b border-line shadow-sm': scrolled || !{{ $isHome ? 'true' : 'false' }},
         'bg-transparent border-b border-white/20': !scrolled && {{ $isHome ? 'true' : 'false' }}
     }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-aptrg.png') }}" alt="APTRG Logo" class="h-12 w-12 rounded-full object-contain">
                    <div>
                        <span class="block text-lg font-bold tracking-tight transition-colors {{ $isHome ? 'text-white' : 'text-ink' }}"
                              :class="(scrolled || !{{ $isHome ? 'true' : 'false' }}) ? 'text-ink' : 'text-white'">
                            APTRG
                        </span>
                        <span class="block text-xs font-medium transition-colors {{ $isHome ? 'text-white/80' : 'text-body' }}"
                              :class="(scrolled || !{{ $isHome ? 'true' : 'false' }}) ? 'text-body' : 'text-white/80'">
                            Telkom University
                        </span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-8">
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="inline-flex items-center h-20 px-1 text-sm font-semibold transition-colors border-b-4 {{ $link['active'] ? 'border-primary text-primary' : ($isHome ? 'border-transparent text-white hover:text-primary hover:border-primary/40' : 'border-transparent text-ink hover:text-primary hover:border-primary/40') }}"
                       :class="{
                           'border-primary text-primary': {{ $link['active'] ? 'true' : 'false' }},
                           'border-transparent text-ink hover:text-primary hover:border-primary/40': !{{ $link['active'] ? 'true' : 'false' }} && (scrolled || !{{ $isHome ? 'true' : 'false' }}),
                           'border-transparent text-white hover:text-primary hover:border-primary/40': !{{ $link['active'] ? 'true' : 'false' }} && !scrolled && {{ $isHome ? 'true' : 'false' }}
                       }">
                        {{ $link['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex items-center md:hidden">
                <button type="button" 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        aria-label="Toggle navigation menu"
                        class="p-2 rounded-lg focus:outline-none transition-colors {{ $isHome ? 'text-white hover:text-primary' : 'text-ink hover:text-primary' }}"
                        :class="(scrolled || !{{ $isHome ? 'true' : 'false' }}) ? 'text-ink hover:text-primary' : 'text-white hover:text-primary'">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-cloak 
         @click.away="mobileMenuOpen = false"
         class="md:hidden bg-surface border-b border-line px-4 pt-2 pb-6 space-y-1">
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}"
               class="block px-3 py-3 rounded-lg text-base font-semibold border-l-4 {{ $link['active'] ? 'border-primary bg-primary-light text-primary' : 'border-transparent text-ink hover:bg-canvas' }}">
                {{ $link['name'] }}
            </a>
        @endforeach
    </div>
</nav>
