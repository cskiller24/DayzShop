<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dark:bg-secondary">
    <main class="min-h-screen flex flex-col justify-between">
        <div class="d-flex flex-col">
            <header class="container mx-auto mb-3">
                <x-nav />
            </header>
            <section class="container mx-auto mb-auto">
                {{ $slot }}
            </section>
        </div>
        <footer class="h-auto mt-8">
        </footer>
    </main>
</body>

</html>
