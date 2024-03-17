<div x-data="{filter: false}">
    <div class="relative w-full h-[500px]  flex justify-center overflow-hidden">
        <div class="absolute bottom-0 w-full h-full from-zinc-950 bg-gradient-to-t z-[1]"></div>
        <div class="absolute inset-0 object-cover w-full h-full bg-center bg-no-repeat -z-0 brightness-50"
            style="background-image: url({{ $game->getImage($game->banner) }}); background-size: co$ver;">
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
                    <a wire:navigate href="{{route('find-player.advertise-vacancy', ['slug' => $game->slug])}}"
                        class="px-4 py-2 text-base font-semibold bg-primary-600 hover:bg-primary-700">
                        ANUNCIAR VAGA
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-container>
        <div
            class="flex flex-col gap-4 mt-6 text-2xl font-bold md:gap-0 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center w-full gap-2">
                <img class="object-contain size-16" src="{{ $game->getImage($game->photo) }}" alt="{{ $game->name }}">
                <h1 class="w-full">
                    {{ $game->name }}
                </h1>
            </div>
            <p class="w-full text-end">
                {{ $vacancies->total() }} Vagas disponíveis
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
            <div>
                <x-primary-button x-on:click="filter = !filter">
                    Exibir filtros
                </x-primary-button>
            </div>
        </div>
        @dump([$position_id, $character_id, $rank_min_id, $rank_max_id])
        <div x-show="filter" x-cloak x-transition:enter="transition duration-300 ease-out transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-200 ease-in transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="flex justify-end w-full gap-6 mt-8">
            <div class="w-full">
                <x-input-label value="Posição" for="position_id" :error="$errors->get('position_id')" />
                <livewire:components.select-with-image :items="$game->positions" :gameId="$game->id" />
            </div>
            @if ($game->has_characters)
            <div class="w-full">
                <x-input-label value="Posição" for="position_id" :error="$errors->get('position_id')" />
                <livewire:components.select-with-image :items="$game->characters" :gameId="$game->id" />
            </div>
            @endif
            <div class="w-full">
                <x-input-label :required="true" value="Rank mínimo" for="rank_min_id"
                    :error="$errors->get('rank_min_id')" />
                <livewire:components.select-with-image wire_model="rank_min" :items="$game->ranks"
                    :gameId="$game->id" />
            </div>
            <div class="w-full">
                <x-input-label :required="true" value="Rank maxímo" for="rank_max_id"
                    :error="$errors->get('rank_max_id')" />
                <livewire:components.select-with-image wire_model="rank_max" :items="$game->ranks"
                    :gameId="$game->id" />
            </div>
        </div>
        <div class="grid w-full grid-flow-row grid-cols-1 gap-6 mt-12 lg:grid-cols-2">
            @foreach ($vacancies as $v)
            <x-find-player.card :vacancy="$v" />
            @endforeach
        </div>
        <div class="mt-12">
            {{$vacancies->links()}}
        </div>
    </x-container>
</div>