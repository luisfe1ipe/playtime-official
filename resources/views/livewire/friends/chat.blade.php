<div x-data="{ modalAddFriend: false }">
    {{-- <div class="grid h-screen grid-cols-9">
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
            <div class="flex flex-col justify-between overflow-y-scroll h-[calc(100vh-56px)] border">
                <!-- Conteúdo da conversa -->
                @for ($i = 0; $i < 20; $i++)
                    <div class="flex items-center gap-2">
                        <img class="rounded-full size-12" src="{{ Auth::user()->photo }}" alt="">
                        <p>{{ Auth::user()->nick }}</p>
                    </div>
                @endfor

            </div>

        </div>
    </div> --}}
    <div class="grid h-screen grid-cols-9 ">
        <div class="h-full col-span-2 bg-white border-r border-gray-300 dark:border-zinc-800 dark:bg-zinc-900">
            <div class="sticky top-0 max-h-screen p-3 overflow-hidden transition-all ease-in hover:overflow-y-scroll">
                <div class="flex items-center justify-between w-full h-10 gap-1">
                    <div class="relative w-full h-full">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                            <svg wire:loading.remove wire:target='searchItem'
                                class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
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
                <div class="relative flex flex-col w-full gap-1 mt-8">
                    @for ($i = 0; $i < 20; $i++)
                        <div
                            class="flex items-center gap-2 p-2 transition-all ease-in rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-zinc-800">
                            <img class="object-cover rounded-full size-14" src="{{ Auth::user()->photo }}"
                                alt="">
                            <div class="flex flex-col gap-1 truncate">
                                <p class="font-semibold">{{ Auth::user()->nick }}</p>
                                <span class="text-xs text-gray-600 truncate dark:text-gray-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi accusantium
                                    consequatur
                                    optio
                                    illo molestias facere? Sed fugiat quibusdam, quas, illum inventore eos consectetur
                                    neque
                                    delectus illo vel aperiam tenetur rem?
                                </span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between h-full col-span-7 bg-gray-100 dark:bg-zinc-950">
            <div
                class="sticky top-0 z-10 w-full px-6 py-2 bg-white border-b border-gray-300 dark:bg-zinc-900 dark:border-zinc-800">
                <div class="flex items-center gap-2">
                    <img class="rounded-full size-12" src="{{ Auth::user()->photo }}" alt="">
                    <p>{{ Auth::user()->nick }}</p>
                </div>
            </div>

            <div class="flex flex-col flex-1 gap-4 p-6">
                @for ($i = 0; $i < 20; $i++)
                    <div class="flex justify-start w-full">
                        <div class="inline-block p-2 bg-white dark:bg-zinc-800 max-w-[55%] rounded-lg relative">
                            <svg class="absolute top-[8px] -left-[20px] rotate-180 size-10 text-white dark:text-zinc-800"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, neque corporis dolores
                            illum
                            eos fugit obcaecati cupiditate, amet a laborum magnam quia praesentium commodi dolorem
                            dolore
                            ipsa suscipit reiciendis maxime!
                        </div>
                    </div>
                    <div class="flex justify-end w-full">
                        <div class="inline-block p-2 bg-[#BF85F6] dark:bg-primary-700 max-w-[55%] rounded-lg relative">
                            <svg class="absolute top-[8px] -right-[20px] size-10 text-[#BF85F6] dark:text-primary-700"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M10.271 5.575C8.967 4.501 7 5.43 7 7.12v9.762c0 1.69 1.967 2.618 3.271 1.544l5.927-4.881a2 2 0 0 0 0-3.088l-5.927-4.88Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, neque corporis dolores
                            illum
                            eos fugit obcaecati cupiditate, amet a laborum magnam quia praesentium commodi dolorem
                            dolore
                            ipsa suscipit reiciendis maxime!
                        </div>
                    </div>
                @endfor
            </div>
            <div
                class="sticky bottom-0 flex justify-between w-full gap-6 p-4 bg-white border-t border-gray-300 dark:border-zinc-800 dark:bg-zinc-900">
                <button
                    class="flex items-center justify-center h-full p-2 transition-all ease-in bg-gray-200 border-none rounded-lg hover:bg-gray-300 dark:hover:bg-zinc-700 dark:bg-zinc-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="w-6 h-6 text-gray-500 lucide lucide-paperclip dark:text-gray-300">
                        <path
                            d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                    </svg>
                </button>
                <div class="relative w-full h-full">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
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
                    <input
                        class="w-full h-full bg-gray-200 border-none rounded-lg focus:ring-primary-500 pl-9 dark:bg-zinc-800"
                        placeholder="Mensagem" type="search">
                </div>
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
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
