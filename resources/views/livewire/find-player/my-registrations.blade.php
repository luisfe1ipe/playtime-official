<div>
    <x-container>
        <div
            class="flex flex-col gap-4 mt-12 text-2xl font-bold md:gap-0 md:flex-row md:items-center md:justify-between">
            <h1 class="w-full">
                Minhas inscrições
            </h1>
            <p class="w-full text-end">
                {{ $vacancies->total() }} Vagas
            </p>
        </div>
        <div class="flex items-end justify-between">
            <div class="relative w-full mt-12 lg:w-1/2">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg wire:loading.remove class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <div wire:loading>
                        <x-filament::loading-indicator class="w-5 h-5" />
                    </div>
                </div>
                <x-text-input wire:model.live='search' type="search" class="w-full pl-10"
                    placeholder='Digite o ID ou o titulo da vaga' />
            </div>
            <div class="flex items-center justify-between gap-6" x-data="{orderBy: false}">
                <div class="relative" @click.outside='orderBy = false' @close.stop="orderBy = false">
                    <x-secondary-button x-on:click="orderBy = !orderBy">
                        Ordenar por
                    </x-secondary-button>
                    <div class="absolute right-0 z-20 w-full p-2 border rounded-lg shadow-lg max-h-44 lg:w-44 top-10 lg:top-12 shadow-black border-zinc-800 bg-zinc-900"
                        x-cloak x-show="orderBy" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <div class="grid grid-cols-1 gap-y-1">
                            <div>
                                <input type="radio" id="recent" wire:model.live='selectedOrder' value="desc"
                                    class="hidden peer" required>
                                <label for="recent"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-950 dark:peer-checked:bg-zinc-950 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Mais recentes
                                    </p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="older" wire:model.live='selectedOrder' value="asc"
                                    class="hidden peer" required>
                                <label for="older"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-950 dark:peer-checked:bg-zinc-950 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Mais antigos
                                    </p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="active_true" wire:model.live='selectedOrder' value="active_true"
                                    class="hidden peer" required>
                                <label for="active_true"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-950 dark:peer-checked:bg-zinc-950 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Ativos
                                    </p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="active_false" wire:model.live='selectedOrder' value="active_false"
                                    class="hidden peer" required>
                                <label for="active_false"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-950 dark:peer-checked:bg-zinc-950 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Inativos
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <x-primary-button x-on:click="$dispatch('open-modal', 'filter')">
                    Filtros
                </x-primary-button>
            </div>
        </div>
        @if($filters)
        <div class="mt-10">
            <div class="flex justify-between">
                @if (array_key_exists('game_select', $filters) && $filters['game_select'] !== null)
                <div>
                    <div class="flex items-center gap-2">
                        <img class="rounded-lg size-10" src="{{Storage::url($filters['game_select']['photo'])}}"
                            alt="Foto {{$filters['game_select']['name']}}">
                        <div class="flex flex-col">
                            <p>{{$filters['game_select']['name']}}</p>
                            <span class="text-xs text-gray-300">
                                Jogo
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                @if ($game_select && $game_select?->has_characters && array_key_exists('character', $filters) &&
                $filters['character']
                !== null)
                <div>
                    <div class="flex items-center gap-2">
                        <img class="rounded-lg size-10" src="{{Storage::url($filters['character']['image'])}}"
                            alt="Foto {{$filters['character']['name']}}">
                        <div class="flex flex-col">
                            <p class="text-lg">{{$filters['character']['name']}}</p>
                            <span class="text-xs text-gray-300">
                                Personagem
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                @if (array_key_exists('position', $filters) && $filters['position'] !== null)
                <div>
                    <div class="flex items-center gap-2">
                        <img class="rounded-lg size-10" src="{{Storage::url($filters['position']['image'])}}"
                            alt="Foto {{$filters['position']['name']}}">
                        <div class="flex flex-col">
                            <p class="text-lg">{{$filters['position']['name']}}</p>
                            <span class="text-xs text-gray-300">
                                Posição
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                @if (array_key_exists('rank_min', $filters) && $filters['rank_min'] !== null)
                <div>
                    <div class="flex items-center gap-2">
                        <img class="object-contain h-10 max-w-24" src="{{Storage::url($filters['rank_min']['image'])}}"
                            alt="Foto {{$filters['rank_min']['name']}}">
                        <div class="flex flex-col">
                            <p class="text-lg">{{$filters['rank_min']['name']}}</p>
                            <span class="text-xs text-gray-300">
                                Rank minímo
                            </span>
                        </div>
                    </div>
                </div>
                @endif
                @if (array_key_exists('rank_max', $filters) && $filters['rank_max'] !== null)
                <div>
                    <div class="flex items-center gap-2">
                        <img class="object-contain h-10 max-w-24" src="{{Storage::url($filters['rank_max']['image'])}}"
                            alt="Foto {{$filters['rank_max']['name']}}">
                        <div class="flex flex-col">
                            <p class="text-lg">{{$filters['rank_max']['name']}}</p>
                            <span class="text-xs text-gray-300">
                                Rank maxímo
                            </span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
        <div class="grid w-full grid-flow-row grid-cols-1 gap-6 mt-12 lg:grid-cols-2">
            @foreach ($vacancies as $v)
            <x-find-player.card :vacancy="$v" :custom="true" />
            @endforeach
        </div>
    </x-container>
    <x-modal name="filter" title="Filtros">
        <div class="p-6">
            <div>
                <p class="mb-2">Selecione um jogo para exibir os outros filtros.</p>
                <livewire:components.select-with-image :absolute="false" :items="$games" gameId="{{null}}" />
            </div>
            @if ($game_select)
            <div class="flex flex-col gap-4 mt-4">
                @if($game_select->has_characters)
                <div class="w-full">
                    <x-input-label value="Personagem" />
                    <livewire:components.select-with-image :absolute="false" :items="$game_select->characters"
                        :gameId="$game_select->id" />
                </div>
                @endif
                <div class="w-full">
                    <x-input-label value="Posição" />
                    <livewire:components.select-with-image :absolute="false" :items="$game_select->positions"
                        :gameId="$game_select->id" />
                </div>
                <div class="flex items-start justify-between gap-6">
                    <div class="w-full">
                        <x-input-label value="Rank minímo" />
                        <livewire:components.select-with-image wire_model="rank_min" :absolute="false"
                            :items="$game_select->ranks" :gameId="$game_select->id" />
                    </div>
                    <div class="w-full">
                        <x-input-label value="Rank maxímo" />
                        <livewire:components.select-with-image wire_model="rank_max" :absolute="false"
                            :items="$game_select->ranks" :gameId="$game_select->id" />
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="flex justify-end w-full gap-6 px-6 pb-4">
            <x-secondary-button wire:click='clearFilter'>
                Limpar filtros
                <div wire:loading wire:target='clearFilter'>
                    <x-filament::loading-indicator class="w-5 h-5" />
                </div>
            </x-secondary-button>
            <x-primary-button x-on:click="$dispatch('close')">
                Confirmar
            </x-primary-button>
        </div>
    </x-modal>
</div>