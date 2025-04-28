@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-serif text-base p-3 px-4 rounded-lg bg-primary/10 text-primary transition-colors duration-200']) }}>
        {{ $status }}
    </div>
@endif