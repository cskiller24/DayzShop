@props([
    'reversed' => false,
])

@php
    $class = 'px-4 py-2 border border-transparent dark:bg-secondary bg-primary dark:text-primary text-secondary rounded transition-all dark:hover:bg-primary dark:hover:text-secondary hover:bg-secondary hover:text-primary hover:border-primary dark:hover:border-secondary focus:ring-primary-400 focus:outline-none focus:ring-2 dark:focus:ring-secondary-400';

    if($reversed) {
        $class = 'px-4 py-2 border border-transparent bg-secondary dark:bg-primary text-primary dark:text-secondary rounded transition-all hover:bg-primary hover:text-secondary dark:hover:bg-secondary dark:hover:text-primary dark:hover:border-primary hover:border-secondary dark:focus:ring-primary-400 focus:outline-none focus:ring-2 focus:ring-secondary-400';
    }
@endphp

<button
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>
