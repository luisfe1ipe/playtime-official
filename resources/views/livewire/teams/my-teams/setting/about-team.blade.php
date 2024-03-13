<div>
    <x-container>
        <div class="grid grid-cols-8">
            <div class="sticky top-0 flex flex-col items-center w-full h-64 col-span-2 pt-24">
                <div class="flex flex-col items-center w-full">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-900 rounded-md relative  flex flex-col justify-center items-center">
                        @if ($team->image)
                        <img class="object-cover w-full h-full rounded-md" src="{{ Storage::url($team->image) }}"
                            alt="Foto {{$team->name}}">
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
                            <x-team.settings.link class="bg-zinc-800"
                                :href="route('my-teams.settings.about', ['slug' => $team->slug])"
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
                            <x-team.settings.link :href="route('my-teams.settings.appearance', ['slug' => $team->slug])"
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
                <h1 class="text-4xl font-bold">Sobre</h1>
                <p class="text-gray-400">
                    Deixe que outras pessoas aprendam mais sobre sua equipe adicionando informações relevantes.
                </p>
                <form wire:submit.prevent='save' class="mt-6">
                    <h3 class="mb-6 text-xl font-bold">Informações</h3>
                    <div class="flex flex-col gap-6">
                        <div>
                            <x-input-label value="Nome" :error="$errors->get('name')" />
                            <x-text-input wire:model='name' :error="$errors->get('name')" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label value="Descrição" :error="$errors->get('description')" />
                            <x-textarea wire:model='description' :value="$description" cols="30" rows="8" />
                            <x-input-error :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label value="URL do site" :error="$errors->get('site_url')" />
                            <x-text-input wire:model='site_url' :error="$errors->get('site_url')" />
                            <span class="text-sm text-gray-400">Caso seu time tenha um website, digite a URL
                                aqui.</span>
                            <x-input-error :messages="$errors->get('site_url')" />
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 mt-12">
                        <h3 class="text-xl font-bold">Redes Sociais</h3>
                        <div class="flex items-start gap-2">
                            <x-icons.discord />
                            <div class="w-full">
                                <x-text-input wire:model='discord_url' :error="$errors->get('discord_url')" />
                                <x-input-error :messages="$errors->get('discord_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.facebook />
                            <div class="w-full">
                                <x-text-input wire:model='facebook_url' :error="$errors->get('facebook_url')" />
                                <x-input-error :messages="$errors->get('facebook_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.instagram />
                            <div class="w-full">
                                <x-text-input wire:model='instagram_url' :error="$errors->get('instagram_url')" />
                                <x-input-error :messages="$errors->get('instagram_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.twitter />
                            <div class="w-full">
                                <x-text-input wire:model='twitter_url' :error="$errors->get('twitter_url')" />
                                <x-input-error :messages="$errors->get('twitter_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.twitch />
                            <div class="w-full">
                                <x-text-input wire:model='twitch_url' :error="$errors->get('twitch_url')" />
                                <x-input-error :messages="$errors->get('twitch_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.youtube />
                            <div class="w-full">
                                <x-text-input wire:model='youtube_url' :error="$errors->get('youtube_url')" />
                                <span class="text-sm text-gray-400">
                                    Envie o link o link do video, caso não saiba como fazer veja o
                                    <a href="#" target="_blank" class="no-underline text-primary-500 hover:underline">
                                        tutorial.
                                    </a>
                                </span>
                                <x-input-error :messages="$errors->get('youtube_url')" />
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 mt-12">
                        <div>
                            <h3 class="mb-2 text-xl font-bold">Contato</h3>
                            <p class="text-gray-400">Informe um email para que os membros possam entrar em contato.</p>
                        </div>
                        <x-text-input wire:model='email' :error="$errors->get('email')" />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                    <div class="flex justify-end w-full mt-12">
                        <x-primary-button type="submit">
                            <p wire:loading.remove wire:target='save'>
                                Salvar
                            </p>
                            <div wire:loading wire:target='save'>
                                <x-filament::loading-indicator class="w-5 h-5" />
                            </div>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</div>