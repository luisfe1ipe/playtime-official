@props(['active'])

@php
$classes = ($active ?? false)
? 'flex items-center justify-between w-full gap-2 px-4 py-2 transition-all ease-in bg-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-800 dark:bg-zinc-800'
: 'flex items-center justify-between w-full gap-2 px-4 py-2 transition-all ease-in rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-800';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>