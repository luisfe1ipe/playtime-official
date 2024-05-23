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
            <x-team.settings.nav-options :team="$team" active="appearance" />
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
                                <img class="object-cover w-full h-full rounded-md"
                                    src="{{ Storage::url($team->image) }}" alt="{{ $team->name }}">
                            @else
                                <svg class="size-24 text-zinc-600" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round">
                                    <path d="M18 21a8 8 0 0 0-16 0" />
                                    <circle cx="10" cy="8" r="5" />
                                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                </svg>
                            @endif
                            <button type="button" x-on:click.prevent="$dispatch('open-modal', 'edit-image')"
                                class="absolute bottom-0 flex flex-col items-center justify-center w-10 h-10 transition-all ease-linear border-2 rounded-full cursor-pointer border-zinc-700 bg-zinc-800 hover:bg-zinc-700 -right-3 ">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                <img class="object-cover w-full h-full rounded-md"
                                    src="{{ Storage::url($team->banner) }}" alt="Banner {{ $team->name }}">
                            @else
                                <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-image">
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
        <x-modal maxWidth='md' name="edit-image" title="Editar imagem do time">
            <livewire:teams.edit-photo-team :team="$team" @saved="$refresh">
        </x-modal>
        <x-modal maxWidth='2xl' name="edit-banner" title="Editar banner do time">
            <livewire:teams.edit-banner-team :team="$team" @saved="$refresh">
        </x-modal>
    </x-container>
</div>
