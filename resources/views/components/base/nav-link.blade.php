@props(['is_active' => false])

@php
    $class = 'block py-2 px-3 hover:underline cursor-pointer ';
    $class .= $is_active ? 'text-white dark:text-secondary-900' : 'text-primary dark:text-secondary-600';
@endphp

<a
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
