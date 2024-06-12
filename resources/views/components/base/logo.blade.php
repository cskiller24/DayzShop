@props([
    'reversed' => false,
    'imgClass' => null,
])

<picture {{ $attributes }}>
    <source srcset="{{ Vite::image('/logo/secondary.svg') }}" media="(prefers-color-scheme: {{ $reversed ? 'light' : 'dark' }})">
    <source srcset="{{ Vite::image('/logo/primary.svg') }}" media="(prefers-color-scheme: {{ $reversed ? 'dark' : 'light' }})">
    <img src="{{ Vite::image('/logo/primary.svg') }}" class="{{ $imgClass ?? 'w-auto h-48 mx-auto' }}" alt="Logo">
</picture>
