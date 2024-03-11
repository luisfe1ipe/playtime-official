<div>
    <x-container>
        <h1 class="mt-12 text-2xl font-bold">Ultimas notícias</h1>
        <div class="flex flex-col items-center gap-5 mt-6 lg:gap-0 lg:flex-row lg:justify-between">
            <div class="relative w-full lg:w-1/2">
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
                <x-text-input wire:model.live='search' type="search" class="w-full pl-10" placeholder='Digite aqui' />
            </div>
            <div x-data="{ type: false, orderBy: false }"
                class="relative grid grid-cols-2 gap-3 lg:flex lg:w-full lg:justify-end">
                <div @click.outside='type = false' @close.stop="type = false">
                    <div class="w-full lg:w-auto">
                        <button
                            class="w-full px-2 py-1 transition-colors ease-linear border rounded-lg hover:bg-zinc-800 border-zinc-800"
                            x-on:click="type = !type" x-bind:class="{ 'bg-zinc-800': type }">
                            Categorias
                        </button>
                    </div>
                    <div class="absolute right-0 z-20 w-full p-2 bg-white border rounded-lg shadow-lg top-10 lg:top-9 dark:border-transparent dark:bg-zinc-800"
                        x-cloak x-show="type" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <div class="grid grid-cols-2 overflow-y-scroll lg:grid-cols-6 gap-y-1 max-h-48">
                            @foreach ($types as $type)
                            <div
                                class="px-2 py-2 transition-all ease-linear rounded-lg hover:bg-gray-100 dark:hover:bg-zinc-900">
                                <div class="flex items-center">
                                    <label class="relative inline-flex items-center w-full cursor-pointer">
                                        <input wire:model.live='selectedTypes' type="checkbox" value="{{ $type->id }}"
                                            class="w-4 h-4 transition duration-100 ease-in-out rounded form-checkbox border-secondary-200 text-primary-500 focus:ring-primary-500 dark:ring-offset-dark-900"
                                            id="{{ $type->id }}">
                                        <p class="w-full ml-2 text-sm font-medium">
                                            {{ $type->name }}
                                        </p>
                                    </label>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div @click.outside='orderBy = false' @close.stop="orderBy = false">
                    <div class="w-full lg:w-auto">
                        <button
                            class="w-full px-2 py-1 transition-colors ease-linear border rounded-lg hover:bg-zinc-800 border-zinc-800"
                            x-on:click="orderBy = !orderBy" x-bind:class="{ 'bg-zinc-800': orderBy }">
                            Ordenar por
                        </button>
                    </div>
                    <div class="absolute right-0 z-20 w-full p-2 overflow-y-scroll bg-white border rounded-lg shadow-lg max-h-44 lg:w-44 top-10 lg:top-9 dark:border-transparent dark:bg-zinc-800"
                        x-cloak x-show="orderBy" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <div class="grid grid-cols-1 gap-y-1">
                            <div>
                                <input type="radio" id="recent" wire:model.live='selectedOrder' value="recent"
                                    class="hidden peer" required>
                                <label for="recent"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-900 dark:peer-checked:bg-zinc-900 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Mais recentes
                                    </p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="older" wire:model.live='selectedOrder' value="older"
                                    class="hidden peer" required>
                                <label for="older"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-900 dark:peer-checked:bg-zinc-900 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Mais antigos
                                    </p>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="views" wire:model.live='selectedOrder' value="views"
                                    class="hidden peer" required>
                                <label for="views"
                                    class="flex px-2 py-2 transition-all ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-900 dark:peer-checked:bg-zinc-900 peer-checked:bg-gray-100 peer-checked:text-primary-500">
                                    <p class="w-full ml-2 text-sm font-medium">
                                        Mais vistos
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($selectType) || $selectedOrder != 'recent')
        <div class="flex justify-end w-full mt-2">
            <button class="text-xs font-medium px-2.5 py-0.5 rounded bg-red-900 text-red-300" wire:click='resetFilter'>
                Limpar filtros
            </button>
        </div>
        @endif
        <div class="mt-8">
            @if ($news->isEmpty())
            {{--
            <x-search-not-found :search="$search" /> --}}
            @else
            @foreach ($news as $n)
            <a href="{{route('news.show', $n->id)}}"
                class="flex flex-col justify-between w-full mb-8 bg-transparent border-b-2 shadow cursor-pointer border-primary-500 group hover:bg-zinc-900 rounded-t-md lg:flex-row lg:h-48">
                <div class="relative w-full overflow-hidden lg:w-80 rounded-t-md">
                    <img class="w-full h-full transition ease-out group-hover:scale-110 delay-50 rounded-t-md"
                        src="{{ $n->image }}" alt="">
                    <div class="absolute px-4 py-1 text-xs font-bold text-white top-2 left-2"
                        style="background:{{ $n->type->color }};">
                        {{ $n->type->name }}
                    </div>
                </div>
                <div class="w-full lg:w-[72%] px-3 py-2 gap-2 lg:gap-0 flex flex-col justify-between">
                    <div>
                        <h2 class="mb-3 text-xl font-bold line-clamp-2">{{ $n->title }}</h2>
                        <div class="truncate">
                            {{ strip_tags($n->subtitle) }}
                        </div>
                    </div>
                    <div class="flex justify-center w-full gap-12 lg:justify-end">

                        <span class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <div class="hidden mr-1 lg:block">Por <strong>{{ $n->user->name }}</strong>,</div>
                            {{ $this->formatDate($n->created_at) }}
                        </span>
                        <span class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            {{ $n->views }}
                            Visualizações
                        </span>
                    </div>

                </div>
            </a>
            @endforeach
            @endif
            {{ $news->links('livewire::tailwind') }}
        </div>
    </x-container>
</div>