<div x-data="{ modalAddFriend: false }">
    <div class="grid h-screen grid-cols-9">
        <div
            class="sticky top-0 left-0 h-screen col-span-2 p-3 bg-white border-r border-gray-300 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-center justify-between w-full h-10 gap-1">
                <div class="relative w-full h-full">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                        <svg wire:loading.remove wire:target='searchItem' class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <div wire:loading wire:target='searchItem'>
                            <x-filament::loading-indicator class="w-5 h-5" />
                        </div>
                    </div>
                    <input
                        class="w-full h-full bg-gray-200 border-none rounded-lg focus:ring-primary-500 pl-9 dark:bg-zinc-800"
                        placeholder="Pesquisar amigo" type="search">
                </div>
                <button x-on:click="modalAddFriend = !modalAddFriend"
                    class="flex items-center justify-center h-full p-2 transition-all ease-in bg-gray-200 border-none rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-700 dark:bg-zinc-800">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>
            </div>
            <div class="relative flex flex-col w-full h-[80%] gap-1 mt-8 overflow-hidden hover:overflow-y-scroll">
                @for ($i = 0; $i < 20; $i++)
                    <div
                        class="flex items-center gap-2 p-2 transition-all ease-in rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-zinc-800">
                        <img class="object-cover rounded-full size-14" src="{{ Auth::user()->photo }}" alt="">
                        <div class="flex flex-col gap-1 truncate">
                            <p class="font-semibold">{{ Auth::user()->nick }}</p>
                            <span class="text-xs text-gray-600 truncate dark:text-gray-300">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi accusantium consequatur
                                optio
                                illo molestias facere? Sed fugiat quibusdam, quas, illum inventore eos consectetur neque
                                delectus illo vel aperiam tenetur rem?
                            </span>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="h-screen col-span-7 bg-gray-100 dark:bg-zinc-950">
            <div class="w-full px-6 py-2 bg-white border-b border-gray-300 dark:bg-zinc-900 dark:border-zinc-800">
                <div class="flex items-center gap-2">
                    <img class="rounded-full size-12" src="{{ Auth::user()->photo }}" alt="">
                    <p>{{ Auth::user()->nick }}</p>
                </div>
            </div>
            <div class="h-[calc(100vh - 56px)] overflow-y-scroll">
                <!-- Conteúdo da conversa -->
            </div>

        </div>
    </div>
    <div x-cloak x-show="modalAddFriend" class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0">
        <div x-show="modalAddFriend" class="fixed inset-0 transition-all transform backdrop-blur-sm"
            x-on:click="modalAddFriend = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
        </div>
        <div x-show="modalAddFriend"
            class="max-w-4xl transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-900 sm:w-full sm:mx-auto"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="flex items-center gap-2 border-b dark:border-zinc-800">
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 flex items-center pointer-events-none left-4 rtl:inset-r-0 start-0 ps-3">
                        <svg wire:loading.remove wire:target='searchItem'
                            class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <div wire:loading wire:target='searchItem'>
                            <x-filament::loading-indicator class="w-5 h-5" />
                        </div>
                    </div>
                    <input class="w-full h-full p-4 bg-transparent border-none rounded-lg pl-14 focus:ring-0"
                        placeholder="Digite o nick do usuário" type="text">
                </div>
                <button x-on:click="modalAddFriend = !modalAddFriend"
                    class="p-2 mr-2 transition-all ease-in rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-700">
                    <svg class="text-gray-500 size-5 dark:text-gray-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>

                </button>
            </div>

        </div>
    </div>
</div>
