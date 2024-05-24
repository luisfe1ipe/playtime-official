<div x-data="{inviteUsers: false}">
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
            <x-team.settings.nav-options :team="$team" active="members" />
            <div class="w-full col-span-6 px-8 pt-24">
                <div class="flex flex-col gap-2">
                    <h1 class="text-4xl font-bold">Membros</h1>
                    <p class="text-gray-400">Gerencie e convide novos membros para o seu time aqui.</p>
                </div>
                @if ($team->user_id === auth()->user()->id)
                    <div class="pb-6 border-b-[1.5px] border-zinc-800">
                        <div x-on:click="inviteUsers = !inviteUsers"
                            class="w-full p-4 mt-2 transition-all ease-linear border rounded-md cursor-pointer border-zinc-800 hover:bg-zinc-700/20">
                            <div class="flex items-center w-full h-full gap-4">
                                <div class="flex items-center justify-center bg-gray-800 rounded-full h-14 w-14">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="text-gray-500 size-6 lucide lucide-user-plus">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                        <circle cx="9" cy="7" r="4" />
                                        <line x1="19" x2="19" y1="8" y2="14" />
                                        <line x1="22" x2="16" y1="11" y2="11" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">Convidar</p>
                                    <span class="text-sm text-gray-400">convide um novo membro para o time</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-container>
    <div x-on:close-modal.window="inviteUsers = false" x-cloak x-show="inviteUsers"
        class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0">
        <div x-show="inviteUsers" class="fixed inset-0 transition-all transform backdrop-blur-sm"
            x-on:click="inviteUsers = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
        </div>
        <div x-show="inviteUsers"
            class="max-w-2xl transition-all transform bg-white rounded-lg shadow-xl dark:bg-zinc-900 sm:w-full sm:mx-auto"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="flex items-center gap-2 border-b dark:border-zinc-800">
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 flex items-center pointer-events-none left-4 rtl:inset-r-0 start-0 ps-3">
                        <svg wire:loading.remove wire:target='search' class="w-4 h-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <div wire:loading wire:target='search'>
                            <x-filament::loading-indicator class="w-5 h-5" />
                        </div>
                    </div>
                    <input wire:model.live='search' x-ref="inputSearch"
                        class="w-full h-full p-4 bg-transparent border-none rounded-lg pl-14 focus:ring-0"
                        placeholder="Digite o nick do usuário" type="text">
                </div>
                <button x-on:click="inviteUsers = !inviteUsers"
                    class="p-2 mr-2 transition-all ease-in rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-700">
                    <svg class="text-gray-500 size-5 dark:text-gray-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>

                </button>
            </div>
            <div class="flex flex-col gap-3 p-4 overflow-x-hidden rounded-b-lg max-h-80 dark:bg-zinc-900">
                @forelse ($users as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img class="rounded-full size-12" src="{{ $user->photo }}"
                                alt="Foto {{ $user->nick }}">
                            <p>{{ $user->nick }}</p>
                        </div>
                        <x-primary-button wire:click='invite("{{$user->email}}")'>
                            Convidar
                            <div wire:target='invite' wire:loading>
                                <x-filament::loading-indicator class="w-5 h-5" />
                            </div>
                        </x-primary-button>
                    </div>
                @empty
                    <div class="text-gray-500 dark:text-gray-300">
                        <p class="mb-2 text-lg font-medium">
                            Insira o nick do usuário que você deseja adicionar membro do seu time.
                        </p>
                        <span>
                            Se nenhum usuário for exibido, pode ser que ele não exista.
                        </span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
