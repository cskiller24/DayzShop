<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title ?? 'Page Title'}}</title>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ $head ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body {{ $attributes->except(['title', 'description']) }} {{ $attributes->merge(['class' => 'dark:bg-secondary dark:text-primary text-secondary']) }}>

{{ $slot }}

{{ $footer ?? "" }}

@stack('scripts')

</body>
</html>
