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
            <div class="absolute w-full h-full from-gray-100 dark:from-zinc-950 bg-gradient-to-t bottom-20">

            </div>
            <div
                class="absolute bottom-0 w-full h-1/5 bg-gray-100 from-gray-100 dark:bg-zinc-950 dark:from-zinc-950 bg-gradient-to-t z-[1]">
            </div>
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
            <h3 class="mb-3">Selecione algum jogo abaixo para ver as informações.</h3>
            @foreach ($user->games as $game)
                <button
                    class="@if ($game_select->id == $game->id) dark:text-white border-primary-600 border-[1.5px] bg-primary-500/30 @else border-[1.5px] border-gray-300 dark:border-none @endif px-5 py-3 transition-colors ease-linear rounded-lg cursor-pointer bg-white hover:bg-primary-500/30 shadow dark:bg-zinc-900  dark:hover:bg-zinc-800"
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
                    <h3 class="mb-3">Informações sobre {{ $game_select->name }}</h3>
                    <div>
                        @if ($game_select->pivot->description)
                            <div>
                                <p class="font-semibold">Descrição</p>
                                <x-section class="p-6 mt-3 border rounded-lg">
                                    <p>
                                        {{ $game_select->pivot->description }}
                                    </p>
                                </x-section>
                                <br>
                            </div>
                        @endif
                        <div>
                            <p class="mb-3 font-semibold">Horários que costumo jogar</p>
                            <div class="flex flex-wrap gap-6 mb-6">
                                @foreach (json_decode($game_select->pivot->days_times_play, true) as $day => $details)
                                    <x-section
                                        class="inline-flex items-center w-auto overflow-hidden border rounded-lg">
                                        <x-section class="px-6 py-2 border-r rounded-l-lg">
                                            <p class="text-sm font-medium text-zinc-400 ">Dia</p>
                                            <span
                                                class="font-bold text-gray-600 dark:text-zinc-200">{{ $day }}</span>
                                        </x-section>
                                        <div class="flex items-center">
                                            @if (isset($details['start']))
                                                <x-section class="px-6 py-2">
                                                    <p class="text-sm font-medium text-zinc-400">Inicio</p>
                                                    <span
                                                        class="font-bold text-gray-600 dark:text-zinc-200">{{ $details['start'] }}</span>
                                                </x-section>
                                            @endif
                                            @if (isset($details['end']))
                                                <x-section class="px-6 py-2 border-l">
                                                    <p class="text-sm font-medium text-zinc-400">Fim</p>
                                                    <span
                                                        class="font-bold text-gray-600 dark:text-zinc-200">{{ $details['end'] }}</span>
                                                </x-section>
                                            @endif
                                        </div>
                                    </x-section>
                                @endforeach
                            </div>
                        </div>
                        @if ($characters != null)
                            <p class="font-semibold">Personagens</p>
                            <div class="flex flex-wrap w-full gap-6 mt-3">
                                @foreach ($characters as $ch)
                                    <x-section class="inline-flex items-center gap-3 px-5 py-3 border rounded-lg">
                                        <img class="size-8" src="{{ $ch->getImage($ch->image) }}" alt="">
                                        <p>
                                            {{ $ch->name }}
                                        </p>
                                    </x-section>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-6">
                            <p class="font-semibold">Posições</p>
                            <div class="flex flex-wrap w-full gap-6 mt-3">
                                @foreach ($positions as $position)
                                    <x-section class="inline-flex items-center gap-3 px-5 py-3 border rounded-lg">
                                        <img class="size-8 brightness-75 dark:brightness-100" src="{{ $position->getImage($position->image) }}"
                                            alt="">
                                        <p>
                                            {{ $position->name }}
                                        </p>
                                    </x-section>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="mb-3 font-semibold">Rank</p>
                            <x-section class="inline-flex items-center gap-3 px-5 py-3 border rounded-lg">
                                <img class="h-8" src="{{ $rank[0]->getImage($rank[0]->image) }}" alt="">
                                <p>
                                    {{ $rank[0]->name }}
                                </p>
                            </x-section>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-container>
</div>
