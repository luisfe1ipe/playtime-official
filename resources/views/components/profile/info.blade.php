<div class="flex flex-col items-center w-full pt-24 lg:top-0 lg:h-64 lg:col-span-2 lg:sticky">
    <div class="flex flex-col items-center w-full">
        <div
            class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-900 rounded-md relative  flex flex-col justify-center items-center">
            <img class="object-cover w-full h-full rounded-md" src="{{ $user->getImage($user->photo) }}"
                alt="Foto {{ $user->name }}">
            <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-round">
                <path d="M18 21a8 8 0 0 0-16 0" />
                <circle cx="10" cy="8" r="5" />
                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
            </svg>
        </div>
        <h3 class="mt-2">{{ $user->name }}</h3>
    </div>
    <nav class="w-full mt-6 mb-6 lg:px-10 lg:mb-0">
        <ul class="flex w-full gap-6 font-bold lg:gap-1 lg:flex-col">
            <li class="w-full">
                <x-team.settings.link :href="route('profile.edit', $user->nick)">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-info">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                    </svg>
                    Sobre
                </x-team.settings.link>
            </li>
            <li class="w-full">
                <x-team.settings.link :href="route('profile.add-game', $user->nick)">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-gamepad-2">
                        <line x1="6" x2="10" y1="11" y2="11" />
                        <line x1="8" x2="8" y1="9" y2="13" />
                        <line x1="15" x2="15.01" y1="12" y2="12" />
                        <line x1="18" x2="18.01" y1="10" y2="10" />
                        <path
                            d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z" />
                    </svg>
                    Adicionar jogo
                </x-team.settings.link>
            </li>
        </ul>
    </nav>
</div>
