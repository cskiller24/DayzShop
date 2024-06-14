@php
    $class = 'link-opacity-100-hover link-underline-light text-light';
@endphp

<a
    {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
