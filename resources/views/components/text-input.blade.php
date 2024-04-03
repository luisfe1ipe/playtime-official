@props(['disabled' => false, 'error' => null])

@php
$errorClass = $error ? 'border-red-400 text-red-400' : 'border-gray-300 dark:border-zinc-700';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full rounded-lg shadow-sm
outline-none transition duration-75 border focus:ring-1 focus:ring-inset disabled:opacity-70 bg-white dark:bg-zinc-900
focus:ring-primary-500
 focus:border-primary-500 ' . $errorClass]) !!} >