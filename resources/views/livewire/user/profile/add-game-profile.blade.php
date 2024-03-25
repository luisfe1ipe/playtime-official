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
                        <li class="w-full">
                            <x-team.settings.link class="border border-zinc-800" :href="route('profile.edit')"
                                :active="request()->routeIs('profile.edit')">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-info">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 16v-4" />
                                    <path d="M12 8h.01" />
                                </svg>
                                Sobre
                            </x-team.settings.link>
                        </li>
                        <li>
                            <x-team.settings.link class="bg-zinc-800" :href="route('profile.add-game')"
                                :active="request()->routeIs('profile.add-game')">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gamepad-2">
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
            <div class="w-full col-span-6 px-8 pt-24">
                <div class="pb-8 border-b border-zinc-800">
                    <h1 class="text-4xl font-bold">Adicione um jogo ao seu perfil</h1>
                    <p class="text-gray-400">
                        Dê mais personalidade ao seu perfil! <br> Adicione um ou mais jogos que você costuma jogar e
                        deixe
                        os
                        outros saberem
                        quais são os seus favoritos.
                    </p>
                </div>
                <form wire:submit.prevent='save' class="mt-4">
                    <div>
                        <p class="text-lg font-semibold">Escolha um jogo</p>
                        <span class="text-gray-400">
                            Para continuar com o cadastro, selecione um jogo da nossa lista.
                        </span>
                        <div class="flex flex-wrap w-full gap-6 mt-4">
                            @foreach ($games as $game)
                            <div wire:key={{$game->id}} wire:click='$set("game_select_id", {{$game->id}})'>
                                <input type="radio" id="game-{{$game->id}}" value="{{$game->id}}" class="hidden peer"
                                    required />
                                <label for="game-{{$game->id}}"
                                    class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                    <div class="flex items-center gap-4">
                                        <img class="rounded-lg size-12" src="{{$game->getImage($game->photo)}}"
                                            alt="Foto {{$game->name}}">
                                        <p class="w-full font-semibold">{{$game->name}}</p>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-2">
                            @if ($game_select)
                            <div class="mt-6">
                                @if ($game_select->has_characters)
                                <p class="text-lg font-semibold">Escolha um ou mais personagens</p>
                                <span class="text-gray-400">
                                    Selecione os personagens que você domina e prefere jogar.
                                </span>
                                <div class="flex flex-wrap gap-6 mt-4">
                                    @foreach ($game_select->characters->sortBy('name') as $ch)
                                    <div>
                                        <input type="checkbox" id="character-{{$ch->id}}" value="{{$ch->id}}"
                                            wire:model='characters_select' class="hidden peer">
                                        <label for="character-{{$ch->id}}"
                                            class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                            <div class="flex items-center gap-4">
                                                <img class="size-8" src="{{$ch->getImage($ch->image)}}"
                                                    alt="Foto {{$ch->name}}">
                                                <p class="w-full font-semibold">{{$ch->name}}</p>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="mt-6">
                                <p class="text-lg font-semibold">Selecione uma ou mais posições</p>
                                <span class="text-gray-400">
                                    Escolha as posições que você domina e prefere jogar.
                                </span>
                                <div class="flex flex-wrap gap-6 mt-4">
                                    @foreach ($game_select->positions->sortBy('name') as $position)
                                    <div>
                                        <input type="checkbox" id="position-{{$position->id}}" value="{{$position->id}}"
                                            wire:model='positions_select' class="hidden peer">
                                        <label for="position-{{$position->id}}"
                                            class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                            <div class="flex items-center gap-4">
                                                <img class="size-8" src="{{$position->getImage($position->image)}}"
                                                    alt="Foto {{$position->name}}">
                                                <p class="w-full font-semibold">{{$position->name}}</p>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-lg font-semibold">Escolha seu nível de habilidade</p>
                                <span class="text-gray-400">
                                    Selecione seu rank para que os outros saibam o seu nível de habilidade.
                                </span>
                                <div class="flex flex-wrap gap-6 mt-4">
                                    @foreach ($game_select->ranks->sortBy('name') as $rank)
                                    <div>
                                        <input type="radio" id="rank-{{$rank->id}}" value="{{$rank->id}}"
                                            wire:model='rank_select' class="hidden peer">
                                        <label for="rank-{{$rank->id}}"
                                            class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                            <div class="flex items-center gap-4">
                                                <img class="h-8" src="{{$rank->getImage($rank->image)}}"
                                                    alt="Foto {{$rank->name}}">
                                                <p class="w-full font-semibold">{{$rank->name}}</p>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-6">
                                <p class="text-lg font-semibold">Selecione os dias que você joga</p>
                                <span class="text-gray-400">
                                    Selecione seu rank para que os outros saibam o seu nível de habilidade.
                                </span>
                                <div class="flex flex-col gap-6">
                                    <div class="flex items-center border rounded-lg border-zinc-700">
                                        <div class="w-full px-3 py-2 text-center rounded-l-lg bg-zinc-900">
                                            <p>Segunda-feira</p>
                                        </div>
                                        <div class="relative w-full text-center">
                                            <input type="time"
                                                class="w-full border-none group bg-zinc-800 focus:ring-1 focus:ring-primary-500" />
                                            <div
                                                class="absolute inset-y-0 right-0 z-10 flex items-center px-3 pointer-events-none hover:cursor-pointer group-focus:border-primary-500 bg-zinc-800">
                                                <svg class="text-zinc-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-clock">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full px-3 py-2 text-center bg-zinc-900">
                                            <p>as</p>
                                        </div>
                                        <div class="relative w-full text-center">
                                            <input type="time"
                                                class="w-full border-none rounded-r-lg group bg-zinc-800 focus:ring-1 focus:ring-primary-500" />
                                            <div
                                                class="absolute inset-y-0 right-0 z-10 flex items-center px-3 rounded-r-lg pointer-events-none hover:cursor-pointer group-focus:border-primary-500 bg-zinc-800">
                                                <svg class="text-zinc-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-clock">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end w-full gap-6 mt-16">
                                <x-secondary-button>
                                    Cancelar
                                </x-secondary-button>
                                <x-primary-button type="submit">
                                    Confirmar
                                </x-primary-button>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</div>