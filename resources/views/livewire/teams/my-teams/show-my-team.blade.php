<div>
    <x-container>
        <div class="h-[400px] relative"
            style="background-image: url({{ Storage::url($team->banner) }}); background-size: cover;">
            <div class="absolute w-full h-full from-zinc-950 bg-gradient-to-t bottom-20">

            </div>
            <div class="absolute bottom-0 w-full h-1/5 bg-zinc-950 from-zinc-950 bg-gradient-to-t z-[1]"></div>
            <div class="absolute bottom-0 w-full max-w-7xl mx-auto px-6 lg:px-8 z-[1]">
                <div class="flex w-full gap-8">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-800 rounded-md relative  flex flex-col justify-center items-center">
                        @if ($team->image)
                            <img class="object-cover w-full h-full rounded-md" src="{{ Storage::url($team->image) }}"
                                alt="Imagem {{ $team->name }}">
                        @else
                            <svg class="size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-users-round">
                                <path d="M18 21a8 8 0 0 0-16 0" />
                                <circle cx="10" cy="8" r="5" />
                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                            </svg>
                        @endif
                    </div>
                    <div class="flex items-center justify-between w-full">
                        <div class="flex flex-col gap-6">
                            <h1 class="text-4xl font-semibold">{{ $team->name }}</h1>
                            <p>{{ $team->members->count() }} membros</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 mx-auto mt-8 max-w-7xl lg:px-8">
            @if (Auth::user()->id === $team->user_id)
                <div class="flex items-center justify-end">
                    <a wire:navigate href="{{ route('my-teams.settings.about', ['slug' => $team->slug]) }}"
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
            @endif
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
                            @if ($team->site_url != null)
                                <a href="{{ $team->site_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.site />
                                    <p class="group-hover:text-primary-600">
                                        {{ $team->site_url }}
                                    </p>
                                </a>
                            @endif
                            @if ($team->discord_url != null)
                                <a href="{{ $team->discord_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.discord />
                                    <p class="group-hover:text-primary-600">
                                        {{ $team->discord_url }}
                                    </p>
                                </a>
                            @endif
                            @if ($team->facebook_url != null)
                                <a href="{{ $team->facebook_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.facebook />
                                    <p class="group-hover:text-primary-600">
                                        {{ $team->facebook_url }}
                                    </p>
                                </a>
                            @endif
                            @if ($team->instagram_url != null)
                                <a href="{{ $team->instagram_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.instagram />
                                    <p class="group-hover:text-primary-600">
                                        {{ $team->instagram_url }}
                                    </p>
                                </a>
                            @endif
                            @if ($team->twitter_url != null)
                                <a href="{{ $team->twitter_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.twitter />
                                    <p class="group-hover:text-primary-600">
                                        {{ $team->twitter_url }}
                                    </p>
                                </a>
                            @endif
                            @if ($team->twitch_url != null)
                                <a href="{{ $team->twitch_url }}" target="_blank"
                                    class="group w-full p-2 flex items-center gap-2 rounded-md border-[1.5px] border-primary-800 hover:bg-zinc-900 transition-all ease-linear">
                                    <x-icons.twitch />
                                    <p class="group-hover:text-primary-600">
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
                            <div class="flex flex-col justify-between h-full px-2 py-4">
                                <a href="{{ route('profile', ['nick' => $team->user->nick]) }}"
                                    class="flex items-center w-full gap-2 p-2 transition-colors ease-in rounded-lg group dark:hover:bg-zinc-900">
                                    <div class="overflow-hidden rounded-lg size-14">
                                        <img class="object-cover w-full h-full" src="{{ $team->user->photo }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <p class="font-semibold group-hover:text-primary-600">{{ $team->user->nick }}
                                        </p>
                                        <span class="px-2 py-0.5 text-xs rounded-lg text-primary-200 bg-primary-600">
                                            Líder
                                        </span>
                                    </div>
                                </a>
                                @foreach ($team->members->take(5) as $member)
                                    <a href="{{ route('profile', ['nick' => $member->nick]) }}"
                                        class="flex items-center w-full gap-2 p-2 transition-colors ease-in rounded-lg group dark:hover:bg-zinc-900">
                                        <div class="overflow-hidden rounded-lg size-14">
                                            <img class="object-cover w-full h-full" src="{{ $member->photo }}"
                                                alt="">
                                        </div>
                                        <div>
                                            <p class="font-semibold group-hover:text-primary-600">{{ $member->nick }}
                                            </p>
                                            <span class="text-sm dark:text-gray-300">membro desde:
                                                {{ \Carbon\Carbon::parse($member->pivot->created_at)->format('d/m/Y') }}</span>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="flex items-center justify-center w-full mt-4">
                                    <a href="{{ route('my-teams.settings.members', ['slug' => $team->slug]) }}"
                                        class="text-sm font-semibold cursor-pointer text-primary-500 hover:underline">Ver
                                        todos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
