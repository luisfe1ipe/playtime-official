<div>
    <x-container>
        <div x-data="{ orderBy: false }" class="flex items-end justify-between w-full">
            <div class="relative w-full mt-12 lg:w-[87%]">
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
                    placeholder='Digite o nome do time' />
            </div>
            <div class="relative w-full lg:w-auto" @click.outside='orderBy = false' @close.stop="orderBy = false">
                <x-secondary-button class="flex justify-center w-full lg:justify-start" x-on:click="orderBy = !orderBy">
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
        </div>
        <h1 class="my-4">
            {{ $teams->total() }} Times
        </h1>
        <div class="grid grid-cols-2 gap-6">
            @foreach ($teams as $team)
                <x-section class="p-4 rounded-lg">
                    <div
                        class="relative flex items-center justify-center h-48 overflow-hidden rounded-lg dark:bg-zinc-700">
                        @if ($team->image)
                            <img class="absolute object-cover overflow-hidden border rounded-lg dark:border-zinc-700 dark:bg-zinc-800 bottom-2 size-20 left-2"
                                src="{{ Storage::url($team->image) }}" alt="Imagem {{ $team->image }}">
                        @else
                            <div
                                class="absolute flex items-center justify-center overflow-hidden rounded-lg dark:bg-zinc-800 bottom-2 size-20 left-2">
                                <svg class="text-gray-800 size-10 dark:text-zinc-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </div>
                        @endif
                        @if ($team->banner)
                            <img class="object-cover w-full h-full" src="{{ Storage::url($team->banner) }}"
                                alt="Banner {{ $team->banner }}">
                        @else
                            <svg class="text-gray-800 size-12 dark:text-zinc-500" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Zm.394 9.553a1 1 0 0 0-1.817.062l-2.5 6A1 1 0 0 0 8 19h8a1 1 0 0 0 .894-1.447l-2-4A1 1 0 0 0 13.2 13.4l-.53.706-1.276-2.553ZM13 9.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>
                    <p class="my-2 text-lg font-bold">
                        {{ $team->name }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="overflow-hidden rounded-full size-14 dark:bg-zinc-700">
                                <img class="object-cover w-full h-full" src="{{ $team->user->photo }}"
                                    alt="Imagem {{ $team->user->nick }}">
                            </div>
                            <div>
                                <a class="block font-bold transition-all ease-in text-primary-500 hover:underline"
                                    wire:navigate
                                    href="{{ route('profile', ['nick' => $team->user->nick]) }}">{{ '@' . $team->user->nick }}</a>
                                <span
                                    class=" bg-primary-100 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">
                                    Líder
                                </span>
                            </div>
                        </div>
                        <a wire:navigate href="{{ route('my-teams.show', ['slug' => $team->slug]) }}"
                            class="flex gap-1 items-center focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 bg-primary-600 hover:bg-primary-700 focus:ring-primary-900">
                            Visualizar
                        </a>
                    </div>
                </x-section>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $teams->links() }}
        </div>
    </x-container>
</div>
