@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-primary/30 text-start text-base font-medium text-primary bg-primary/10 focus:outline-none focus:bg-primary/20 focus:border-primary/50 transition-all duration-200 ease-in-out rounded-r'
            : 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-transparent text-start text-base font-medium text-secondary/80 hover:text-primary hover:bg-primary/5 hover:border-primary/20 focus:outline-none focus:text-primary focus:bg-primary/10 focus:border-primary/30 transition-all duration-200 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>