<!DOCTYPE html class="dark">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dark:bg-secondary-800 bg-white dark:text-primary text-secondary">
    @livewire('components.toaster')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        {{ $slot }}
    </div>
</body>

</html>
