<div>
    <x-container>
        <div class="grid grid-cols-8">
            <x-profile.info :user="$user"/>
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
                                <div wire:key='{{ $game->id }}'
                                    wire:click='$set("game_select_id", {{ $game->id }})'>
                                    <input type="radio" id="game-{{ $game->id }}" name="hosting"
                                        value="{{ $game->id }}" class="hidden peer" required />
                                    <label for="game-{{ $game->id }}"
                                        class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                        <div class="flex items-center gap-4">
                                            <img class="rounded-lg size-12" src="{{ $game->getImage($game->photo) }}"
                                                alt="Foto {{ $game->name }}">
                                            <p class="w-full font-semibold">{{ $game->name }}</p>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if ($user->games->where('id', $game_select?->id)->first() == null)
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
                                                        <input type="checkbox" id="character-{{ $ch->id }}"
                                                            value="{{ $ch->id }}" wire:model='characters_select'
                                                            class="hidden peer">
                                                        <label for="character-{{ $ch->id }}"
                                                            class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                                            <div class="flex items-center gap-4">
                                                                <img class="size-8"
                                                                    src="{{ $ch->getImage($ch->image) }}"
                                                                    alt="Foto {{ $ch->name }}">
                                                                <p class="w-full font-semibold">{{ $ch->name }}
                                                                </p>
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
                                                    <input type="checkbox" id="position-{{ $position->id }}"
                                                        value="{{ $position->id }}" wire:model='positions_select'
                                                        class="hidden peer">
                                                    <label for="position-{{ $position->id }}"
                                                        class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                                        <div class="flex items-center gap-4">
                                                            <img class="size-8"
                                                                src="{{ $position->getImage($position->image) }}"
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
                                            @foreach ($game_select->ranks->sortBy('name') as $rank)
                                                <div>
                                                    <input type="radio" id="rank-{{ $rank->id }}"
                                                        value="{{ $rank->id }}" wire:model='rank_select'
                                                        class="hidden peer">
                                                    <label for="rank-{{ $rank->id }}"
                                                        class="inline-flex items-center justify-between w-full px-5 py-3 text-gray-500 transition-colors ease-linear border rounded-lg cursor-pointer bg-zinc-900 border-zinc-700 peer-checked:bg-primary-500/10 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:bg-zinc-800">
                                                        <div class="flex items-center gap-4">
                                                            <img class="h-8"
                                                                src="{{ $rank->getImage($rank->image) }}"
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
                                        <div class="flex flex-col gap-6">
                                            <x-add-game.date-time text="Segunda-Feira" />
                                            <x-add-game.date-time text="Terça-Feira" />
                                            <x-add-game.date-time text="Quarta-Feira" />
                                            <x-add-game.date-time text="Quinta-Feira" />
                                            <x-add-game.date-time text="Sexta-Feira" />
                                            <x-add-game.date-time text="Sábado" />
                                            <x-add-game.date-time text="Domingo" />
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <x-input-label value="Descrição" for="description" :error="$errors->get('description')" />
                                        <x-textarea wire:model='description' id="description" :value="$description"
                                            cols="30" rows="8" />
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
                                @endif
                            </div>
                        @else
                            <div class="p-6 mt-12 text-center text-red-300 bg-red-900 rounded-lg">
                                <h2>Você já possui {{ $game_select->name }} cadastrado.</h2>
                                <a wire:navigate
                                    href="{{ route('profile.edit-game', ['nick' => $user->nick, 'game_user_id' => $user->games->where('id', $game_select?->id)->first()->id]) }}"
                                    class="underline">
                                    Clique aqui caso deseja editá-lo.
                                </a>
                            </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </x-container>
</div>
