<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dark:bg-secondary">
    <x-development.theme-toggle />
    <main class="min-h-screen flex flex-col justify-between">
        <header>
            <x-nav />
        </header>
        <section class="">
            {{ $slot }}
        </section>
        <footer class="h-auto">
            <x-footer />
        </footer>
    </main>
</body>

</html>
