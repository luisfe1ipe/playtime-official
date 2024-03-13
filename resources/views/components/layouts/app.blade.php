<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>


    @filamentStyles
    @vite(['resources/css/app.css'])
</head>

<body class="antialiased text-white bg-zinc-950">
    <div class="fixed z-10 px-4 py-2 bottom-4 right-4">
        <button role="button"
            class="inline-flex items-center justify-center text-sm transition-all duration-200 ease-in-out border border-transparent rounded-full outline-none bg-primary-500 focus:ring-offset-white focus:shadow-outline group gap-x-2 hover:shadow-sm focus:border-transparent focus:ring-2 disabled:cursor-not-allowed disabled:opacity-50 w-9 h-9 text-primary-50 ring-primary-500 focus:bg-primary-600 hover:bg-primary-600 focus:ring-offset-2 dark:focus:ring-offset-dark-900 dark:focus:ring-primary-600 dark:bg-primary-700 dark:hover:bg-primary-600 dark:hover:ring-primary-600"
            x-data="{ visible: false }" x-on:scroll.window="visible = window.scrollY > 100"
            x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-show="visible" wire:loading.attr="disabled"
            wire:loading.class="!cursor-wait">
            <svg class="w-4 h-4 text-primary-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <livewire:navbar />
    {{ $slot }}

    @livewire('notifications')

    @filamentScripts
</body>

</html>