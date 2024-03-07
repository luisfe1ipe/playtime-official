@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'filament-forms-input block w-full
rounded-lg shadow-sm outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70
bg-zinc-800 focus:ring-primary-500 border-zinc-600
focus:border-primary-500']) !!}>