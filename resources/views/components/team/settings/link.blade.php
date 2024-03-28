@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center w-full gap-1 p-2 rounded-md bg-zinc-800 hover:bg-zinc-800'
            : 'flex items-center w-full gap-1 p-2 rounded-md border border-zinc-700 hover:bg-zinc-800';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
