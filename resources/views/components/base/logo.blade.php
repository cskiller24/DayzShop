<picture {{ $attributes }}>
    <source srcset="{{ Vite::image('/logo/secondary.svg') }}" media="(prefers-color-scheme: dark)">
    <source srcset="{{ Vite::image('/logo/primary.svg') }}" media="(prefers-color-scheme: light)">
    <img src="{{ Vite::image('/logo/primary.svg') }}" class="w-auto h-48 mx-auto" alt="Logo">
</picture>
