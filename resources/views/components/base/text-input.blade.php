@props([
    'errorKey' => null,
])

@php
    $class = 'form-control';
    if($errorKey && filled($errors->first($errorKey))) {
        $class .= ' is-invalid';
    }
@endphp

<input {{ $attributes->merge(['type' => 'text', 'class' => $class]) }} />
