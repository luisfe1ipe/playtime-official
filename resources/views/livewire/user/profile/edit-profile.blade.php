<div>
    <x-container>
        <div class="grid grid-cols-8">
            <div class="sticky top-0 flex flex-col items-center w-full h-64 col-span-2 pt-24">
                <div class="flex flex-col items-center w-full">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-900 rounded-md relative  flex flex-col justify-center items-center">
                        <img class="object-cover w-full h-full rounded-md" src="{{ $user->getImage($user->photo) }}"
                            alt="Foto {{$user->name}}">
                        <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                    </div>
                    <h3 class="mt-2">{{ $user->name }}</h3>
                </div>
                <nav class="w-full px-10 mt-6">
                    <ul class="flex flex-col w-full gap-1 font-bold">
                        <li>
                            <x-team.settings.link>
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-users-round">
                                    <path d="M18 21a8 8 0 0 0-16 0" />
                                    <circle cx="10" cy="8" r="5" />
                                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                </svg>
                                Membros
                            </x-team.settings.link>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="w-full col-span-6 px-8 pt-24">
                <h1 class="text-4xl font-bold">Sobre</h1>
                <p class="text-gray-400">
                    Deixe que outras pessoas aprendam mais sobre sua equipe adicionando informações relevantes.
                </p>
                <form wire:submit.prevent='save' class="mt-6">
                    <h3 class="mb-6 text-xl font-bold">Informações</h3>
                    
                </form>
            </div>
        </div>
    </x-container>
</div>