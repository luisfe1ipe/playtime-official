<nav x-data=""
    class="sticky top-0 z-30 w-full bg-white border-b border-gray-300 dark:border-zinc-800 dark:bg-zinc-900">
    <x-container>
        <div class="flex items-center justify-between w-full h-20">
            <a href="/" class="text-3xl font-bold text-primary-500">PlayTime</a>
            <div>
                <ul class="flex items-center gap-3">
                    <li>
                        <x-nav-link :href="route('find-player.select-game')" :active="request()->routeIs('find-player.select-game') ||
                            request()->routeIs('find-player.index')">
                            Encontrar Player
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('teams.index')" :active="request()->routeIs('teams.index')">
                            Times
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('news.list')" :active="request()->routeIs('news.list')">
                            Notícias
                        </x-nav-link>
                    </li>
                </ul>
            </div>
            <div>
                @auth
                    <livewire:navbar.notification>
                    @endauth
                    @guest
                        <a class="rounded-lg bg-purple-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-900"
                            href="/auth/google/redirect">Entrar</a>
                    @endguest
            </div>
        </div>
    </x-container>
</nav>
