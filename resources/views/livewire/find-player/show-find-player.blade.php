<div>
    <x-container>
        <nav class="flex mt-6 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-end space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li>
                    <div class="flex items-center">
                        <a wire:navigate href="{{route('find-player.index', ['slug' => $vacancy->game->slug])}}"
                            class="text-sm font-medium text-gray-400 ms-1 hover:text-primary-500 md:ms-2">Encontrar
                            player</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">Visualizar
                            vaga</span>
                    </div>
                </li>
            </ol>
        </nav>
        @if(Auth::user()->id == $vacancy->user->id)
        <div class="flex justify-end w-full gap-8 mb-12">
            <x-danger-button>
                Excluir vaga
            </x-danger-button>
            <x-secondary-button wire:click='active'>
                @if ($vacancy->active)
                Desativar vaga
                @else
                Ativar vaga
                @endif
            </x-secondary-button>
            <a wire:navigate href="{{route('find-player.edit', ['id' => $vacancy->id])}}"
                class="flex gap-1 items-center focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 bg-primary-600 hover:bg-primary-700 focus:ring-primary-900">
                Editar vaga
            </a>
        </div>
        @endif
        <div class="flex w-full gap-6">
            <div class="w-3/5">
                <h1 class="mb-6">Detalhes da vaga</h1>
                <div
                    class="relative px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                    <div class="absolute top-0 px-1 text-xs font-bold bg-primary-700 text-primary-300">
                        {{ $vacancy->id }}
                    </div>
                    @if ($vacancy->game->has_characters)
                    <div class="flex w-full gap-6">
                        <div class="w-full">
                            <img class="object-contain w-full h-20"
                                src="{{$vacancy->character->getImage($vacancy->character->image)}}"
                                alt="{{$vacancy->character->name}}">
                        </div>
                        <div>
                            <p class="mb-3 text-lg font-bold">{{ $vacancy->title }}</p>
                            <p class="text-base">
                                {{ strip_tags($vacancy->description) }}
                            </p>
                        </div>
                    </div>
                    @else
                    <div>
                        <p class="mb-3 text-lg font-bold">{{ $vacancy->title }}</p>
                        <p class="text-base">
                            {{ strip_tags($vacancy->description) }}
                        </p>
                    </div>
                    @endif
                    <div class="flex items-center gap-4 mt-6">
                        <div class="flex flex-col w-full gap-2">
                            <span>Posição</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain size-8"
                                    src="{{$vacancy->position->getImage($vacancy->position->image)}}"
                                    alt="{{$vacancy->position->name}}">
                                <p>{{$vacancy->position->name}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-2">
                            <span>Rank minímo</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain h-8 w-14"
                                    src="{{$vacancy->rankMin->getImage($vacancy->rankMin->image)}}"
                                    alt="{{$vacancy->rankMin->name}}">
                                <p class="truncate">{{$vacancy->rankMin->name}}</p>
                            </div>
                        </div>
                        @if ($vacancy->rank_min_id)
                        <div class="flex flex-col w-full gap-2">
                            <span>Rank maxímo</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain h-8 w-14"
                                    src="{{$vacancy->rankMax->getImage($vacancy->rankMax->image)}}"
                                    alt="{{$vacancy->rankMax->name}}">
                                <p class="truncate">{{$vacancy->rankMax->name}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-2/5 gap-8">
                <div>
                    <h1 class="mb-6">Informações adicionais</h1>
                    <div class="px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="mb-1 text-lg font-bold">Jogo</p>
                                <div class="flex items-center gap-3">
                                    <img class="rounded-full size-12"
                                        src="{{$vacancy->game->getImage($vacancy->game->photo)}}"
                                        alt="Foto {{$vacancy->game->name}}">
                                    <p class="text-base">{{$vacancy->game->name}}</p>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-lg font-bold">Anunciada em</p>
                                <p class="text-base">{{$vacancy->created_at}}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <p class="mb-1 text-lg font-bold">Usuários inscritos</p>
                                <div class="flex items-center gap-3">
                                    <p class="text-base">colocar aqui.</p>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-lg font-bold">Status</p>
                                @if ($vacancy->active)
                                <span
                                    class="text-sm font-medium tracking-wider  px-2.5 py-0.5 rounded bg-green-900 text-green-300">Ativo</span>
                                @else
                                <span
                                    class="tracking-wider ext-sm font-medium me-2 px-2.5 py-0.5 rounded bg-red-900 text-red-300">Fechado</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="mb-6">Anunciada por</h1>
                    <div class="px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                        <div class="flex w-full gap-6">
                            <img class="rounded-full size-24" src="{{$vacancy->user->getImage($vacancy->user->photo)}}"
                                alt="Foto {{$vacancy->user->name}}">
                            <div class="flex flex-col gap-1">
                                <h3>{{$vacancy->user->name}}</h3>
                                <a class="text-primary-300 hover:underline" href="#" target="_blank">Visualizar
                                    perfil</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>