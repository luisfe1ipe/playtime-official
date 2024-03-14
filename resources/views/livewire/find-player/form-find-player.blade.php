<div class="p-6">
    <x-container>
        <nav class="flex mt-3 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-end space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li>
                    <div class="flex items-center">
                        <a wire:navigate href="{{route('find-player.index', ['slug' => $game->slug])}}"
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
                        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">Anunciar
                            vaga</span>
                    </div>
                </li>
            </ol>
        </nav>

        <h1>Anunciar Vaga</h1>
        <p class="mt-1">
            Preencha os detalhes abaixo para criar sua vaga e comece a encontrar parceiros de jogo.
        </p>
        <form wire:submit.prevent='save' class="mt-12">
            <div class="flex flex-col gap-6">
                <div>
                    <x-input-label value="Titulo" :required="true" for="title" :error="$errors->get('title')" />
                    <x-text-input wire:model='title' id="title" :error="$errors->get('title')" />
                    <x-input-error :messages="$errors->get('title')" />
                </div>
                <div>
                    <x-input-label value="Descrição" :required="true" for="description"
                        :error="$errors->get('description')" />
                    <x-textarea wire:model='description' id="description" :error="$errors->get('description')"
                        :value="$description" cols="30" rows="5" />
                    <x-input-error :messages="$errors->get('description')" />
                </div>
                <div class="flex justify-between w-full gap-6">
                    @if ($game->has_characters)
                    <div class="w-1/2">
                        <x-input-label value="Personagem" for="character_id" :error="$errors->get('character_id')" />
                        <livewire:components.select-with-image :items="$characters" :gameId="$game->id" />
                        <x-input-error :messages="$errors->get('character_id')" />
                    </div>
                    @endif
                    <div class="w-1/2">
                        <x-input-label value="Posição" for="position_id" :error="$errors->get('position_id')" />
                        <livewire:components.select-with-image :items="$positions" :gameId="$game->id" />
                        <x-input-error :messages="$errors->get('position_id')" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end w-full gap-6 mt-8">
                <x-secondary-button type='reset'>
                    Cancelar
                </x-secondary-button>
                <x-primary-button type='submit'>
                    Confirmar
                </x-primary-button>
            </div>
        </form>
    </x-container>
</div>