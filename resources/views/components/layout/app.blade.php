@props(['title' => null, 'fullpage' => false])
@php
    $isFullpage = $fullpage || request()->routeIs('home');
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title . ' | APTRG Telkom University' : 'APTRG Telkom University — Fight Together, Win Together' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if ($isFullpage)
        <link rel="preload" as="image" href="{{ asset('images/bg-hero-1.jpg') }}" fetchpriority="high">
    @endif
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="{{ $isFullpage ? 'bg-canvas text-ink font-sans antialiased overflow-hidden' : 'min-h-screen flex flex-col bg-canvas text-ink font-sans antialiased' }}">
    <x-layout.navbar :fullpage="$isFullpage" />

    @if ($isFullpage)
        {{ $slot }}
    @else
        <main class="flex-grow">
            {{ $slot }}
        </main>
        <x-layout.footer />
    @endif

    @stack('scripts')
</body>
</html>
