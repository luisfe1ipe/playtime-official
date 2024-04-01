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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased text-white bg-zinc-950">
    <div class="fixed z-10 px-4 py-2 bottom-4 right-4">
        <button role="button"
            class="inline-flex items-center justify-center text-sm transition-all duration-200 ease-in-out border border-transparent rounded-full outline-none bg-primary-500 focus:ring-offset-white focus:shadow-outline group gap-x-2 hover:shadow-sm focus:border-transparent focus:ring-2 disabled:cursor-not-allowed disabled:opacity-50 w-9 h-9 text-primary-50 ring-primary-500 focus:bg-primary-600 hover:bg-primary-600 focus:ring-offset-2 dark:focus:ring-offset-dark-900 dark:focus:ring-primary-600 dark:bg-primary-700 dark:hover:bg-primary-600 dark:hover:ring-primary-600"
            x-data="{ visible: false }" x-on:scroll.window="visible = window.scrollY > 100"
            x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-show="visible" wire:loading.attr="disabled"
            wire:loading.class="!cursor-wait">
            <svg class="w-4 h-4 text-primary-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <livewire:navbar />
    <div class="min-h-screen">
        {{ $slot }}
    </div>

    <footer class="mt-12 bg-white dark:bg-zinc-900">
        <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#"
                    class="flex items-center mb-4 space-x-3 text-3xl font-bold sm:mb-0 text-primary-500 rtl:space-x-reverse">
                    PlayTime
                </a>
                <ul
                    class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
                Desenvolvido por
                <a href="https://github.com/luisfe1ipe" target="_blank" class="font-bold hover:underline">
                    Luis Felipe
                </a>
            </span>
        </div>
    </footer>

    @livewire('notifications')

    @filamentScripts
</body>

</html>
