@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 text-sm font-bold leading-5 text-primary-500 focus:outline-none
                focus:border-primary-700
                transition duration-150 ease-in-out
                relative inline cursor-pointer before:bg-primary-500  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100
                '
            : 'relative inline cursor-pointer before:bg-primary-500  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100 inline-flex items-center px-1 pt-1 text-sm font-bold leading-5  focus:outline-none transition duration-150 ease-in-out';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
