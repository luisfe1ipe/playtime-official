<div>
    <x-container>
        <div class="h-[400px] relative"
            style="background-image: url({{ $user->getImage($user->banner) }}); background-size: cover;">
            @if ($user->id === Auth::user()->id)
                <div class="absolute top-4 right-6 z-[1]">
                    <button x-on:click.prevent="$dispatch('open-modal', 'edit-banner')"
                        class="flex items-center gap-2 px-4 py-1 transition ease-linear border rounded-md bg-zinc-800 border-zinc-700 hover:bg-zinc-700">
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-camera">
                            <path
                                d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                            <circle cx="12" cy="13" r="3" />
                        </svg>
                        Atualizar banner
                    </button>
                </div>
            @endif
            <div class="absolute w-full h-full from-zinc-950 bg-gradient-to-t bottom-20">

            </div>
            <div class="absolute bottom-0 w-full h-1/5 bg-zinc-950 from-zinc-950 bg-gradient-to-t z-[1]"></div>
            <div class="absolute bottom-0 w-full max-w-7xl mx-auto px-6 lg:px-8 z-[1]">
                <div class="flex items-end w-full gap-8">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-800 rounded-md relative  flex flex-col justify-center items-center">
                        <img class="object-cover w-full h-full rounded-md" src="{{ $user->getImage($user->photo) }}"
                            alt="Imagem {{ $user->name }}">
                        <svg class="size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                        @if ($user->id === Auth::user()->id)
                            <button type="button" x-on:click.prevent="$dispatch('open-modal', 'edit-photo')"
                                class="absolute bottom-0 flex flex-col items-center justify-center w-10 h-10 transition-all ease-linear border-2 rounded-full cursor-pointer border-zinc-700 bg-zinc-800 hover:bg-zinc-700 -right-3 ">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-camera">
                                    <path
                                        d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                    <circle cx="12" cy="13" r="3" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    <div class="flex justify-between w-full">
                        <div>
                            <h2>{{ $user->name }}</h2>
                            <h4 class="font-semibold text-primary-500">{{ '@' . $user->nick }}</h4>
                        </div>
                        <a wire:navigate href="{{ route('profile.edit', $user->nick) }}">
                            Editar perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            @foreach ($user->games as $game)
                <button
                    class="@if ($game_select->id == $game->id) text-white border-primary-600 border-[1.5px] bg-primary-500/30 hover:bg-primary-500/30 @endif px-5 py-3 text-gray-500 transition-colors ease-linear rounded-lg cursor-pointer bg-zinc-900  hover:bg-zinc-800"
                    wire:key={{ $game->id }} wire:click="selectGame({{ $game->id }})">
                    <div class="flex items-center gap-4">
                        <img class="rounded-lg size-12" src="{{ $game->getImage($game->photo) }}"
                            alt="Foto {{ $game->name }}">
                        <p class="w-full font-semibold">{{ $game->name }}</p>
                        <div wire:loading wire:target='selectGame({{ $game->id }})'>
                            <x-filament::loading-indicator class="w-5 h-5" />
                        </div>
                    </div>
                </button>
            @endforeach
            <div class="mt-12">
                @if ($game_select)
                    <div>
                        @if ($game_select->pivot->description)
                            <div>
                                <h3>Descrição</h3>
                                <div class="p-6 mt-3 border rounded-lg border-zinc-700 bg-zinc-900">
                                    <p>
                                        {{ $game_select->pivot->description }}
                                    </p>
                                </div>
                                <br>
                            </div>
                        @endif
                        <div>
                            <h3 class="mb-3">Horários que costumo jogar</h3>
                            <div class="flex flex-wrap gap-6 mb-6">
                                @foreach (json_decode($game_select->pivot->days_times_play, true) as $day => $details)
                                    <div
                                        class="inline-flex items-center w-auto border rounded-lg bg-zinc-900 border-zinc-700">
                                        <div class="px-6 py-2 border-r rounded-l-lg border-zinc-700">
                                            <p class="text-sm font-medium text-zinc-400 ">Dia</p>
                                            <span class="font-bold text-zinc-200">{{ $day }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            @if (isset($details['start']))
                                                <div class="px-6 py-2 border-zinc-700">
                                                    <p class="text-sm font-medium text-zinc-400">Inicio</p>
                                                    <span
                                                        class="font-bold text-zinc-200">{{ $details['start'] }}</span>
                                                </div>
                                            @endif
                                            @if (isset($details['end']))
                                                <div class="px-6 py-2 border-l border-zinc-700">
                                                    <p class="text-sm font-medium text-zinc-400">Fim</p>
                                                    <span class="font-bold text-zinc-200">{{ $details['end'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if ($characters->isNotEmpty())
                            <h3>Personagens</h3>
                            <div class="flex flex-wrap w-full gap-6 mt-3">
                                @foreach ($characters as $ch)
                                    <div
                                        class="inline-flex items-center gap-3 px-5 py-3 text-white transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-700">
                                        <img class="size-8" src="{{ $ch->getImage($ch->image) }}" alt="">
                                        <p>
                                            {{ $ch->name }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-6">
                            <h3>Posições</h3>
                            <div class="flex flex-wrap w-full gap-6 mt-3">
                                @foreach ($positions as $position)
                                    <div
                                        class="inline-flex items-center gap-3 px-5 py-3 text-white transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-700">
                                        <img class="size-8" src="{{ $position->getImage($position->image) }}"
                                            alt="">
                                        <p>
                                            {{ $position->name }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3>Rank</h3>
                            <div
                                class="inline-flex items-center gap-3 px-5 py-3 mt-3 text-white transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-700">
                                <img class="h-8" src="{{ $rank[0]->getImage($rank[0]->image) }}" alt="">
                                <p>
                                    {{ $rank[0]->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-container>
</div>
