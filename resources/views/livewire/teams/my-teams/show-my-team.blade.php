<div>
    <x-container>
        <div class="h-[400px] relative"
            style="background-image: url({{ Storage::url($team->banner) }}); background-size: cover;">
            @if ($team->user->id === auth()->user()->id)
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
                <div class="flex w-full gap-8">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-800 rounded-md relative  flex flex-col justify-center items-center">
                        @if ($team->image)
                        <img class="object-cover w-full h-full rounded-md" src="{{ Storage::url($team->image) }}"
                            alt="Imagem {{$team->name}}">
                        @else
                        <svg class="size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                        @endif
                        @if ($team->user->id === auth()->user()->id)
                        <button type="button" x-on:click.prevent="$dispatch('open-modal', 'edit-photo')"
                            class="absolute bottom-0 flex flex-col items-center justify-center w-10 h-10 transition-all ease-linear border-2 rounded-full cursor-pointer border-zinc-700 bg-zinc-800 hover:bg-zinc-700 -right-3 ">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-camera">
                                <path
                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                        </button>
                        @endif
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <div class="flex flex-col gap-6">
                            <h1 class="text-4xl font-semibold">{{ $team->name }}</h1>
                            <p>membros</p>
                        </div>
                        @if ($team->user->id === auth()->user()->id)
                        <div>
                            <button x-on:click="$dispatch('open-modal', 'invite-member')"
                                class="flex items-center gap-1 px-6 py-3 font-bold uppercase transition-all ease-linear rounded-md hover:bg-primary-500 bg-primary-600">
                                Convidar membro
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 mx-auto mt-8 max-w-7xl lg:px-8">
            <div class="flex items-center justify-end">
                <a href="#"
                    class="flex items-center gap-2 px-4 py-1 font-medium transition ease-linear border rounded-md bg-zinc-800 border-zinc-700 hover:bg-zinc-700">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-settings">
                        <path
                            d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    Configurações
                </a>
            </div>
            <div class="grid grid-cols-3 gap-8 mt-6">
                <div class="flex flex-col col-span-2 gap-6">
                    <h1 class="col-span-2 mb-4 text-2xl font-bold">Visão geral</h1>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2 custom-ul">
                            {!! $team->description !!}
                        </div>
                        @if ($team->email != null)
                        <div>
                            <h1 class="mb-2 text-2xl font-bold">Contato</h1>
                            <p>{{ $team->email }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col w-full h-full col-span-1 gap-6">
                    <div class="flex flex-col gap-6">
                        <div class="flex items-end justify-between h-10">
                            <h1 class="text-2xl font-bold">Redes Sociais</h1>
                        </div>
                        <div class="flex flex-col gap-4">
                            @if ($team->youtube_url != null)
                            <div class="w-full h-64 overflow-hidden bg-gray-800 rounded-md shadow-sm">
                                <iframe class="object-cover w-full h-full" src="{{ $team->youtube_url }}"
                                    frameborder="0"></iframe>
                            </div>
                            @endif
                            @if ($team->discord_url != null)
                            <a href="{{ $team->discord_url }}" target="_blank"
                                class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-sky-800 hover:bg-gray-800 transition-all ease-linear">
                                {{--
                                <x-icons.discord /> --}}
                                <p class="group-hover:text-sky-600">
                                    {{ $team->discord_url }}
                                </p>
                            </a>
                            @endif
                            @if ($team->facebook_url != null)
                            <a href="{{ $team->facebook_url }}" target="_blank"
                                class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-sky-800 hover:bg-gray-800 transition-all ease-linear">
                                {{--
                                <x-icons.facebook /> --}}
                                <p class="group-hover:text-sky-600">
                                    {{ $team->facebook_url }}
                                </p>
                            </a>
                            @endif
                            @if ($team->instagram_url != null)
                            <a href="{{ $team->instagram_url }}" target="_blank"
                                class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-sky-800 hover:bg-gray-800 transition-all ease-linear">
                                {{--
                                <x-icons.instagram /> --}}
                                <p class="group-hover:text-sky-600">
                                    {{ $team->instagram_url }}
                                </p>
                            </a>
                            @endif
                            @if ($team->twitter_url != null)
                            <a href="{{ $team->twitter_url }}" target="_blank"
                                class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-sky-800 hover:bg-gray-800 transition-all ease-linear">
                                {{--
                                <x-icons.twitter /> --}}
                                <p class="group-hover:text-sky-600">
                                    {{ $team->twitter_url }}
                                </p>
                            </a>
                            @endif
                            @if ($team->twitch_url != null)
                            <a href="{{ $team->twitch_url }}" target="_blank"
                                class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-sky-800 hover:bg-gray-800 transition-all ease-linear">
                                {{--
                                <x-icons.twitch /> --}}
                                <p class="group-hover:text-sky-600">
                                    {{ $team->twitch_url }}
                                </p>
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-6">
                        <div class="flex items-end justify-between h-10">
                            <h1 class="text-2xl font-bold">Membros</h1>
                        </div>
                        <div class="w-full h-full rounded-md border-[1.5px] border-primary-500">
                            <ul class="flex flex-col justify-between h-full px-2 py-4">
                                <div class="flex items-center justify-center w-full mt-4">
                                    <a href="#" wire:click="$emit('viewMembers')"
                                        class="text-sm font-semibold cursor-pointer text-primary-500 hover:underline">Ver
                                        todos
                                    </a>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>