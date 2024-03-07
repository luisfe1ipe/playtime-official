<nav x-data="" class="sticky top-0 z-10 w-full dark:bg-zinc-900 dark:border-gray-700">
    <x-container>
        <div class="flex items-center justify-between w-full h-20">
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
                @auth
                <button class="flex items-center gap-2">
                    <div class="overflow-hidden text-center rounded-full w-14 h-14 bg-primary-500">
                        @if(Auth::user()->photo)
                        <img class="w-full h-full" src="{{Auth::user()->photo}}" alt="Foto perfil">
                        @else
                        <img class="w-full h-full"
                            src="https://ui-avatars.com/api/?name={{Auth::user()->name}}&background=random"
                            alt="Foto perfil" />
                        @endif
                    </div>
                    <div class="flex items-end">
                        <p>{{Auth::user()->name}}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </div>
                </button>
                @endauth
                @guest

                <a class="focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 bg-purple-600 hover:bg-purple-700 focus:ring-purple-900"
                    href="/auth/google/redirect">Entrar</a>
                @endguest
            </div>
        </div>
    </x-container>
    <x-modal maxWidth='lg' name="login" title="Login">

    </x-modal>
</nav>