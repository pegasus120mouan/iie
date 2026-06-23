@props([
    'href' => null,
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'logo-default',
        'header' => 'logo-header',
        'footer' => 'logo-footer',
        'admin' => 'logo-admin',
    ];
    $variantClass = $variants[$variant] ?? $variants['default'];
@endphp

<a href="{{ $href ?? route('home') }}" {{ $attributes->merge(['class' => "inline-flex items-center shrink-0 {$variantClass}"]) }}>
    <img
        src="{{ asset(config('iie.logo')) }}"
        alt="{{ config('iie.name') }}"
        class="{{ $variantClass }}__img"
    >
</a>
