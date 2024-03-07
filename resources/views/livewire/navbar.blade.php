<nav class="sticky top-0 z-10 w-full py-2 dark:bg-zinc-900 dark:border-gray-700">
    <x-container>
        <div class="flex items-center justify-between w-full">
            <a href="/" class="text-3xl font-bold text-primary-500">PlayTime</a>
            <div>
                <ul>
                    <li>
                        <x-nav-link
                            :active="request()->routeIs('find-player.select-game') || request()->routeIs('find-player.select-game')">
                            Encontrar Player
                        </x-nav-link>
                    </li>
                </ul>
            </div>
            <div>
                <button class="flex items-center gap-2">
                    <div class="overflow-hidden text-center rounded-full w-14 h-14 bg-primary-500">
                        <img class="w-full h-full" src="" alt="Foto perfil">
                    </div>
                    <div class="flex items-end">
                        <p>Nick usuario</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </x-container>
</nav>