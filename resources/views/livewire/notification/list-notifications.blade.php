<div>
    @use('Carbon\Carbon')
    <x-container>
        <div class="flex flex-col gap-1 px-6 py-3 mt-12 rounded-lg bg-zinc-900">
            @foreach ($notifications as $n)
            <div wire:key='{{$n->id}}'
                class="p-2 transition-colors ease-linear border-l-4 border-transparent rounded-r-lg hover:border-primary-500 hover:bg-zinc-950">
                <div class="flex items-center justify-between gap-3 ml-2">
                    <div class="flex gap-3">
                        <img class="rounded-full size-16" src="{{$n->data['user_registered']['photo']}}"
                            alt="Foto {{$n->data['user_registered']['name']}}">
                        <div>
                            <div class="flex items-center gap-1">
                                <a class="text-primary-400 hover:underline">
                                    {{"@".$n->data['user_registered']['nick']}}
                                </a>
                                <p>
                                    {{$n->data['message']}}
                                </p>
                            </div>
                            <span class="text-xs text-gray-400">
                                {{Carbon::parse($n->created_at)->diffForHumans()}}
                            </span>
                        </div>
                    </div>
                    <div>
                        @if ($n->read_at == null)
                        <span
                            class="bg-rose-100 text-rose-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-rose-900 dark:text-rose-300">Não
                            lida</span>
                        @else
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                            Lida
                        </span>
                        @endif
                    </div>
                    <div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false"
                        class="relative">
                        <div x-on:click="open = ! open"
                            class="p-1 transition-all ease-linear rounded-full cursor-pointer hover:bg-zinc-800 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </div>
                        <div x-show="open" x-cloak
                            class="absolute z-[10] font-medium w-52 rounded-md bg-zinc-900 border border-zinc-800 shadow-lg right-0"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95">
                            <ul class="flex flex-col gap-1 p-2 text-sm">
                                <li>
                                    <button type="button"
                                        class="flex items-center w-full gap-2 p-2 transition-all ease-linear rounded-md cursor-pointer hover:bg-zinc-950">
                                        <svg class="font-bold text-primary-600 size-5 group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <p>
                                            Visualizar
                                        </p>
                                    </button>
                                </li>
                                <li>
                                    @if ($n->read_at == null)
                                    <button type="button" wire:click='readNotification("{{$n->id}}")'
                                        class="flex items-center w-full gap-2 p-2 transition-all ease-linear rounded-md cursor-pointer hover:bg-zinc-950">
                                        <svg class="font-bold text-green-600 size-5 group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="3" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                        <p>
                                            Marcar como lida
                                        </p>
                                    </button>
                                    @endif
                                </li>
                                <li>
                                    <button type="button" wire:click='deleteNotification("{{$n->id}}")'
                                        class="flex items-center w-full gap-2 p-2 transition-all ease-linear rounded-md cursor-pointer hover:bg-zinc-950">
                                        <svg class="font-bold text-rose-600 size-5 group-hover:text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                        <p>
                                            Apagar
                                        </p>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </x-container>
</div>