@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 text-sm font-bold leading-5 text-primary-500 focus:outline-none
focus:border-primary-700
transition duration-150 ease-in-out'
: 'inline-flex items-center px-1 pt-1 text-sm font-bold leading-5 hover:text-gray-200 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
  {{ $slot }}
</a>