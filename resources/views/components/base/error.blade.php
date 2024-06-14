
@props([
    'key' => null,
])

<div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
    {{ $errors->first($key) }}
</div>
