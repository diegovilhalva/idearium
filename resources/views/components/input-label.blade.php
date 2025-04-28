@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-serif text-base font-medium text-secondary mb-2 transition-colors duration-200']) }}>
    {{ $value ?? $slot }}
</label>