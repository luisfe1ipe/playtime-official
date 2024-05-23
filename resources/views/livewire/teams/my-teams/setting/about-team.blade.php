<div>
    <x-container>
        <div class="absolute z-10 px-6 py-4">
            <a wire:navigate href="{{ route('my-teams.show', ['slug' => $team->slug]) }}"
                class="inline-block p-2 rounded-full bg-zinc-800 hover:bg-zinc-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-left">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-8">
           <x-team.settings.nav-options :team="$team" active="about"/>
            <div class="w-full col-span-6 px-8 pt-24">
                <h1 class="text-4xl font-bold">Sobre</h1>
                <p class="text-gray-400">
                    Deixe que outras pessoas aprendam mais sobre sua equipe adicionando informações relevantes.
                </p>
                <form wire:submit.prevent='save' class="mt-6">
                    <h3 class="mb-6 text-xl font-bold">Informações</h3>
                    <div class="flex flex-col gap-6">
                        <div>
                            <x-input-label value="Nome" for="team_name" :error="$errors->get('name')" />
                            <x-text-input wire:model='name' id="team_name" :error="$errors->get('name')" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label value="Descrição" for="description" :error="$errors->get('description')" />
                            <x-textarea wire:model='description' id="description" :value="$description" cols="30"
                                rows="8" />
                            <x-input-error :messages="$errors->get('description')" />
                        </div>
                        <div>
                            <x-input-label value="URL do site" for="site_url" :error="$errors->get('site_url')" />
                            <x-text-input wire:model='site_url' id="site_url" :error="$errors->get('site_url')" />
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
                                <x-text-input wire:model='discord_url' id="discord_url"
                                    :error="$errors->get('discord_url')" />
                                <x-input-error :messages="$errors->get('discord_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.facebook />
                            <div class="w-full">
                                <x-text-input wire:model='facebook_url' id="facebook_url"
                                    :error="$errors->get('facebook_url')" />
                                <x-input-error :messages="$errors->get('facebook_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.instagram />
                            <div class="w-full">
                                <x-text-input wire:model='instagram_url' id="instagram_url"
                                    :error="$errors->get('instagram_url')" />
                                <x-input-error :messages="$errors->get('instagram_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.twitter />
                            <div class="w-full">
                                <x-text-input wire:model='twitter_url' id="twitter_url"
                                    :error="$errors->get('twitter_url')" />
                                <x-input-error :messages="$errors->get('twitter_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.twitch />
                            <div class="w-full">
                                <x-text-input wire:model='twitch_url' id="twitch_url"
                                    :error="$errors->get('twitch_url')" />
                                <x-input-error :messages="$errors->get('twitch_url')" />
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <x-icons.youtube />
                            <div class="w-full">
                                <x-text-input wire:model='youtube_url' id="youtube_url"
                                    :error="$errors->get('youtube_url')" />
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
                        <x-text-input wire:model='email' autocomplete id="email" :error="$errors->get('email')" />
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