<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Kasiinfo Photo Challenge 2026' }}</title>
    <meta name="description" content="Dari tangan-tangan sederhana lahir kemajuan Bumi Paser. Join the Kasiinfo Photo Challenge 2026.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-dark font-sans antialiased overflow-x-hidden relative flex flex-col min-h-screen">

    <x-layouts.navbar />

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <x-layouts.footer />

</body>
</html>
