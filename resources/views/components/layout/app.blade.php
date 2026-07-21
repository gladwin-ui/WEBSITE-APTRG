@props(['title' => null, 'fullpage' => false])
@php
    $isFullpage = $fullpage || request()->routeIs('home');
@endphp

<!DOCTYPE html>
<html lang="id" class="no-js scroll-smooth">
<head>
    <script>document.documentElement.classList.remove('no-js');</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title . ' | APTRG Telkom University' : 'APTRG Telkom University — Fight Together, Win Together' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($isFullpage && request()->routeIs('home'))
        <link rel="preload" as="video" href="{{ route('media.stream', 'aptrg-hero.mp4') }}" type="video/mp4">
    @endif
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="{{ $isFullpage ? 'bg-canvas text-ink font-sans antialiased overflow-x-hidden' : 'min-h-screen flex flex-col bg-canvas text-ink font-sans antialiased' }}">
    <x-layout.navbar :fullpage="$isFullpage" />

    @if ($isFullpage)
        {{ $slot }}
    @else
        <main class="flex-grow pt-20">
            {{ $slot }}
        </main>
        <x-layout.footer />
    @endif

    @stack('scripts')
</body>
</html>
