<div>
    <x-container>
        <div class="lg:grid-cols-8 lg:grid">
            <x-profile.info :user="$user" />
            <div class="w-full lg:px-8 lg:pt-24 lg:col-span-6">
                <h1 class="text-4xl font-bold">Editar jogo</h1>
                <p class="mt-2 text-gray-400">
                    Esta é a área onde você pode personalizar as informações relacionadas ao jogo que você joga. Aqui,
                    você tem o controle total para ajustar detalhes como personagens, posições e rank conforme desejar.
                </p>

                <div class="mt-8">
                    <h3>Jogo selecionado:</h3>
                    <div class="flex items-end justify-between gap-6">
                        <div class="flex items-center gap-2 mt-4">
                            <img class="rounded-lg size-12" src="{{ $game->getImage($game->photo) }}"
                                alt="Foto {{ $game->name }}">
                            <p class="text-lg font-medium">
                                {{ $game->name }}
                            </p>
                        </div>
                        <div>
                            <x-danger-button wire:click='deleteGame'>
                                Excluir jogo do perfil
                                <div wire:loading wire:target='deleteGame'>
                                    <x-filament::loading-indicator class="w-5 h-5" />
                                </div>
                            </x-danger-button>
                        </div>
                    </div>
                </div>
                <form wire:submit.prevent='save' class="mt-6">
                    @if ($game->has_characters)
                        <div>
                            <p class="text-lg font-semibold">Escolha um ou mais personagens</p>
                            <span class="text-gray-400">
                                Selecione os personagens que você domina e prefere jogar.
                            </span>
                            <div class="flex flex-wrap gap-6 mt-4">
                                @foreach ($game->characters->sortBy('name') as $ch)
                                    <div>
                                        <input type="checkbox" id="character-{{ $ch->id }}"
                                            value="{{ $ch->id }}" wire:model='characters_select'
                                            class="hidden peer" @if (in_array($ch->id, json_decode($game->pivot->characters))) checked @endif>
                                        <label for="character-{{ $ch->id }}"
                                            class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                            <div class="flex items-center gap-4">
                                                <img class="size-8" src="{{ $ch->getImage($ch->image) }}"
                                                    alt="Foto {{ $ch->name }}">
                                                <p class="w-full font-semibold">{{ $ch->name }}
                                                </p>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="mt-6">
                        <p class="text-lg font-semibold">Selecione uma ou mais posições</p>
                        <span class="text-gray-400">
                            Escolha as posições que você domina e prefere jogar.
                        </span>
                        <div class="flex flex-wrap gap-6 mt-4">
                            @foreach ($game->positions->sortBy('name') as $position)
                                <div>
                                    <input type="checkbox" id="position-{{ $position->id }}" class="hidden peer"
                                        value="{{ $position->id }}" wire:model='positions_select'
                                        @if (in_array($position->id, json_decode($game->pivot->positions))) checked @endif>
                                    <label for="position-{{ $position->id }}"
                                        class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                        <div class="flex items-center gap-4">
                                            <img class="size-8" src="{{ $position->getImage($position->image) }}"
                                                alt="Foto {{ $position->name }}">
                                            <p class="w-full font-semibold">{{ $position->name }}</p>
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
                            @foreach ($game->ranks->sortBy('name') as $rank)
                                <div>
                                    <input type="radio" id="rank-{{ $rank->id }}" value="{{ $rank->id }}"
                                        wire:model='rank_select' @if ($rank->id == $game->pivot->rank_id) checked @endif
                                        class="hidden peer">
                                    <label for="rank-{{ $rank->id }}"
                                        class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                        <div class="flex items-center gap-4">
                                            <img class="h-8" src="{{ $rank->getImage($rank->image) }}"
                                                alt="Foto {{ $rank->name }}">
                                            <p class="w-full font-semibold">{{ $rank->name }}</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-6">
                        <p class="text-lg font-semibold">Selecione os dias que você joga</p>
                        <span class="text-gray-400">
                            Escolha o horário de início e término das suas sessões de jogo para cada dia da semana.
                        </span>
                        <div class="flex flex-col gap-6 mt-4">
                            <x-add-game.edit.date-time :array="$days_times_play" text="Segunda-Feira" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Terça-Feira" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Quarta-Feira" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Quinta-Feira" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Sexta-Feira" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Sábado" />
                            <x-add-game.edit.date-time :array="$days_times_play" text="Domingo" />

                        </div>
                    </div>
                    <div class="mt-6">
                        <x-input-label value="Descrição" for="description" :error="$errors->get('description')" />
                        <x-textarea wire:model='description' id="description" :value="$description" cols="30"
                            rows="8" />
                        <x-input-error :messages="$errors->get('description')" />
                    </div>
                    <div class="flex justify-end w-full gap-6 mt-16">
                        <x-secondary-button>
                            Cancelar
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            Confirmar
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</div>
