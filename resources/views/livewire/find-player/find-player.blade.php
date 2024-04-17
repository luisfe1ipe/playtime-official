<div x-data="{ filter: false }">
    <div class="relative w-full h-[500px]  flex justify-center overflow-hidden">
        <div class="absolute bottom-0 w-full h-full dark:from-zinc-950 bg-gradient-to-t z-[1]"></div>
        <div class="absolute inset-0 object-cover w-full h-full bg-center bg-no-repeat -z-0 brightness-50"
            style="background-image: url({{ $game->getImage($game->banner) }}); background-size: cover;">
        </div>
        <div class="px-6 lg:px-8 relative w-full h-full max-w-screen-xl z-[1] ">
            <div class="flex flex-col justify-center h-full max-w-lg gap-8 text-white">
                <div class="flex flex-col gap-6">
                    <h1 class="text-4xl font-bold">Encontre seu time</h1>
                    <p class="text-lg">
                        Nosso sistema conecta jogadores de todo o Brasil para encontrar parceiros de equipe que
                        compartilham
                        suas habilidades e objetivos de jogo.
                    </p>
                </div>
                <div>
                    <a wire:navigate href="{{ route('find-player.advertise-vacancy', ['slug' => $game->slug]) }}"
                        class="px-4 py-2 text-base font-semibold bg-primary-600 hover:bg-primary-700">
                        ANUNCIAR VAGA
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-container>
        <div class="flex items-center justify-between mt-6 font-bold">
            <div class="flex items-center w-full gap-2">
                <img class="object-contain rounded-lg size-12 lg:size-16" src="{{ $game->getImage($game->photo) }}"
                    alt="{{ $game->name }}">
                <h1 class="w-full text-2xl ">
                    {{ $game->name }}
                </h1>
            </div>
        </div>
        <div class="flex flex-col gap-4 lg:gap-0 lg:justify-between lg:items-end lg:flex-row">
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
            <div class="flex items-center justify-between w-full gap-6 lg:w-auto" x-data="{ orderBy: false }">
                <div class="relative w-full lg:w-auto" @click.outside='orderBy = false' @close.stop="orderBy = false">
                    <x-secondary-button class="flex justify-center w-full lg:justify-start"
                        x-on:click="orderBy = !orderBy">
                        Ordenar por
                    </x-secondary-button>
                    <div class="absolute right-0 z-20 w-full p-2 border rounded-lg shadow-lg max-h-44 lg:w-44 top-12 shadow-black border-zinc-800 bg-zinc-900"
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
                        </div>
                    </div>
                </div>
                <x-primary-button x-on:click="filter = !filter"
                    class="flex items-end justify-center w-full lg:w-auto lg:justify-start">
                    <span x-text="filter ? 'Ocultar filtros' : 'Exibir filtros'">Exibir filtros</span>
                    <svg x-bind:class="{ 'transform -rotate-180': filter }" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="transition-transform duration-200 transform size-4 lucide lucide-chevron-down">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </x-primary-button>
            </div>
        </div>
        <div x-show="filter" x-cloak x-transition:enter="transition duration-300 ease-out transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-200 ease-in transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="flex flex-col justify-end w-full gap-6 mt-8 lg:flex-row">
            <div class="w-full">
                <x-input-label value="Posição" for="position_id" :error="$errors->get('position_id')" />
                <livewire:components.select-with-image :contrast="true" :items="$game->positions" :gameId="$game->id" />
            </div>
            @if ($game->has_characters)
                <div class="w-full">
                    <x-input-label value="Personagem" for="position_id" :error="$errors->get('position_id')" />
                    <livewire:components.select-with-image :items="$game->characters" :gameId="$game->id" />
                </div>
            @endif
            <div class="w-full">
                <x-input-label value="Rank mínimo" for="rank_min_id" :error="$errors->get('rank_min_id')" />
                <livewire:components.select-with-image wire_model="rank_min" :items="$game->ranks" :gameId="$game->id" />
            </div>
            <div class="w-full">
                <x-input-label value="Rank maxímo" for="rank_max_id" :error="$errors->get('rank_max_id')" />
                <livewire:components.select-with-image wire_model="rank_max" :items="$game->ranks" :gameId="$game->id" />
            </div>
        </div>
        <h2 class="w-full mt-6 text-2xl font-bold">
            {{ $vacancies->total() }} Vagas disponíveis
        </h2>
        <div class="grid w-full grid-flow-row grid-cols-1 gap-6 mt-12 lg:grid-cols-2">
            @foreach ($vacancies as $v)
                <x-find-player.card :vacancy="$v" />
            @endforeach
        </div>
        <div class="mt-12">
            {{ $vacancies->links() }}
        </div>
    </x-container>
</div>
