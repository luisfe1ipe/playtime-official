@props(['disabled' => false, 'error' => null])

@php
$errorClass = $error ? 'border-red-400 text-red-400' : '';
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full rounded-lg shadow-sm
outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70 bg-zinc-900 focus:ring-primary-500
border-zinc-700 focus:border-primary-500 ' . $errorClass]) !!}>