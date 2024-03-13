<div>
    <x-container>
        <div class="grid grid-cols-8">
            <div class="sticky top-0 flex flex-col items-center w-full h-64 col-span-2 pt-24">
                <div class="flex flex-col items-center w-full">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-900 rounded-md relative  flex flex-col justify-center items-center">
                        @if ($team->image)
                        <img class="object-cover w-full h-full rounded-md" src="{{ Storage::url($team->image) }}"
                            alt="Foto {{$team->image}}">
                        @else
                        <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                        @endif
                    </div>
                    <h3 class="mt-2">{{ $team->name }}</h3>
                </div>
                <nav class="w-full px-10 mt-6">
                    <ul class="flex flex-col w-full gap-1 font-bold">
                        @if (auth()->user()->id === $team->user->id)
                        <li class="w-full">
                            <x-team.settings.link :href="route('my-teams.settings.about', ['slug' => $team->slug])"
                                :active="request()->routeIs('my-teams.settings.about')">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-info">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 16v-4" />
                                    <path d="M12 8h.01" />
                                </svg>
                                Sobre
                            </x-team.settings.link>
                        </li>
                        <li>
                            <x-team.settings.link class="bg-zinc-800"
                                :href="route('my-teams.settings.appearance', ['slug' => $team->slug])"
                                :active="request()->routeIs('my-teams.settings.appearance')">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-brush">
                                    <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08" />
                                    <path
                                        d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z" />
                                </svg>
                                Aparência
                            </x-team.settings.link>
                        </li>
                        @endif
                        <li>
                            <x-team.settings.link>
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-users-round">
                                    <path d="M18 21a8 8 0 0 0-16 0" />
                                    <circle cx="10" cy="8" r="5" />
                                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                </svg>
                                Membros
                            </x-team.settings.link>
                        </li>
                    </ul>
                    {{-- @if ($team->members->count() > 0)
                    <button x-on:click.prevent="$dispatch('open-modal', 'quit-team');"
                        class="mt-6 w-full py-2 rounded-full transition ease-linear border-[1.5px] border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-white">
                        Sair do time
                    </button>
                    @endif --}}
                    @if ($team->user->id === auth()->user()->id)
                    <button x-on:click.prevent="$dispatch('open-modal', 'delete-team');" class="mt-4
                                    w-full py-2 rounded-full transition ease-linear border-[1.5px] border-rose-500 text-rose-500
                                    hover:bg-rose-500 hover:text-white">
                        Excluir time
                    </button>
                    @endif
                </nav>
            </div>
            <div class="w-full col-span-6 px-8 pt-24">
                <div class="flex flex-col gap-2">
                    <h1 class="text-4xl font-bold">Aparência</h1>
                    <p class="text-gray-400">Personalize seu time adicionando uma foto e um banner.</p>
                </div>
                <div class="mt-8">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold">Foto</h3>
                        <p class="text-gray-400">A foto ajuda os usuários a reconhecerem facilmente seu time.</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div
                            class="mt-5 w-[10rem] h-[10rem] bg-gray-800 rounded-md relative  flex flex-col justify-center items-center">
                            @if ($team->image != null)
                            <img class="object-cover w-full h-full rounded-md" src="{{ $team->photo }}" alt="">
                            @else
                            <svg class="size-24 text-zinc-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users-round">
                                <path d="M18 21a8 8 0 0 0-16 0" />
                                <circle cx="10" cy="8" r="5" />
                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                            </svg>
                            @endif
                            <button type="button" x-on:click.prevent="$dispatch('open-modal', 'edit-photo')"
                                class="absolute bottom-0 flex flex-col items-center justify-center w-10 h-10 transition-all ease-linear border-2 rounded-full cursor-pointer border-zinc-700 bg-zinc-800 hover:bg-zinc-700 -right-3 ">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-camera">
                                    <path
                                        d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                    <circle cx="12" cy="13" r="3" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm text-gray-400">
                            Recomendamos uma imagem de <strong>256 x 256</strong> pixels.
                        </p>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="flex flex-col gap-2">
                        <h3 class="text-xl font-bold">Banner</h3>
                        <p class="text-gray-400">O banner faz sua equipe se sentir mais única.</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div
                            class="relative flex flex-col items-center justify-center w-full mt-5 bg-gray-800 rounded-md h-80">
                            @if ($team->banner != null)
                            <img class="object-cover w-full h-full rounded-md" src="{{ $team->banner }}" alt="">
                            @else
                            <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                <circle cx="9" cy="9" r="2" />
                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                            </svg>
                            @endif
                            <div class="absolute top-4 right-6 z-[1]">
                                <button x-on:click.prevent="$dispatch('open-modal', 'edit-banner')"
                                    class="flex items-center gap-2 px-4 py-1 transition ease-linear border rounded-md bg-zinc-800 border-zinc-700 hover:bg-zinc-700">
                                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-camera">
                                        <path
                                            d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                        <circle cx="12" cy="13" r="3" />
                                    </svg>
                                    Atualizar banner
                                </button>
                            </div>

                        </div>
                        <p class="text-sm text-gray-400">
                            Recomendamos uma imagem de <strong>2400 x 600</strong> pixels.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>