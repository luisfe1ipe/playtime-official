<div x-data="{ modalAddFriend: false }" class="flex flex-col w-full max-h-screen gap-2 p-3 transition-all ease-in">
    <button x-on:click="modalAddFriend = !modalAddFriend; $nextTick(() => { $refs.inputSearch.focus(); })"
        class="px-4 py-2 text-lg font-bold text-center text-white transition-all ease-in rounded-lg bg-primary-500 hover:bg-primary-600 dark:bg-primary-600 dark:hover:bg-primary-700">
        Adicionar amigo
    </button>
    <x-friend.nav-link :href="route('friends.chat')" :active="request()->routeIs('friends.chat')">
        <span class="flex items-end gap-1">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-message-circle">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
            </svg>
            Chat
        </span>
        {{-- <livewire:friends.side-bar.count-navlink :count="$receivedFriendRequestsCount" /> --}}
    </x-friend.nav-link>
    <x-friend.nav-link :href="route('friends.index')" :active="request()->routeIs('friends.index')">
        <span class="flex items-end gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-users-round">
                <path d="M18 21a8 8 0 0 0-16 0" />
                <circle cx="10" cy="8" r="5" />
                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
            </svg>
            Amigos
        </span>
        {{-- <livewire:friends.side-bar.count-navlink :count="$friendsCount" /> --}}
    </x-friend.nav-link>
    <x-friend.nav-link :href="route('friends.friendship-requests')" :active="request()->routeIs('friends.friendship-requests')">
        <span class="flex items-end gap-1">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-handshake">
                <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                <path
                    d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                <path d="m21 3 1 11h-2" />
                <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                <path d="M3 4h8" />
            </svg>
            Solicitações de amizade
        </span>
        {{-- <livewire:friends.side-bar.count-navlink :count="$receivedFriendRequestsCount" /> --}}
    </x-friend.nav-link>
    <x-friend.nav-link :href="route('friends.friendship-requests')" :active="request()->routeIs('friends.friendship-requests')">
        <span class="flex items-end gap-1">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-send">
                <path d="m22 2-7 20-4-9-9-4Z" />
                <path d="M22 2 11 13" />
            </svg>
            Pedidos enviados
        </span>
        {{-- <livewire:friends.side-bar.count-navlink :count="$receivedFriendRequestsCount" /> --}}
    </x-friend.nav-link>
    <div x-on:close-modal.window="modalAddFriend = false" x-cloak x-show="modalAddFriend"
        class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0">
        <div x-show="modalAddFriend" class="fixed inset-0 transition-all transform backdrop-blur-sm"
            x-on:click="modalAddFriend = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
        </div>
        <div x-show="modalAddFriend"
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
            <div class="flex flex-col gap-3 p-4 overflow-x-hidden rounded-b-lg max-h-80 dark:bg-zinc-900">
                @forelse ($users as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <img class="rounded-full size-12" src="{{ $user->photo }}"
                                alt="Foto {{ $user->nick }}">
                            <p>{{ $user->nick }}</p>
                        </div>
                        <livewire:friends.add-friend wire:key='{{ $user->id }}' user_id="{{ $user->id }}" />
                    </div>
                @empty
                    <div class="text-gray-500 dark:text-gray-300">
                        <p class="mb-2 text-lg font-medium">
                            Insira o nome de usuário que você deseja adicionar como amigo.
                        </p>
                        <span>
                            Se nenhum usuário for exibido, pode ser que ele não exista ou que vocês já sejam amigos.
                            Você
                            pode verificar sua lista de amigos <a wire:navigate class="underline text-primary-500"
                                href="{{ route('friends.index') }}">aqui</a>.
                        </span>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
