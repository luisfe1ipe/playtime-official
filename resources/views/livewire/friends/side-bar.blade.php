<div class="w-full max-h-screen p-3 transition-all ease-in">
    <x-friend.nav-link :href="route('friends.friendship-requests')" :active="request()->routeIs('friends.friendship-requests')">
        <span class="flex items-end gap-1">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
        <livewire:friends.side-bar.count-navlink :count="$receivedFriendRequestsCount" />
    </x-friend.nav-link>
</div>
