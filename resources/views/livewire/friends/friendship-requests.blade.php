<div class="p-6 mb-32">
    @use('Carbon\Carbon')
    <div class="flex flex-col justify-between gap-4 mb-6">
        <h1>{{ $receivedFriendRequests->total() }} Solicitações de Amizade</h1>
        <div class="relative w-1/2">
            <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                <svg wire:loading.remove wire:target='search' class="w-4 h-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <div wire:loading wire:target='search'>
                    <x-filament::loading-indicator class="w-5 h-5" />
                </div>
            </div>
            <input wire:model.live='search'
                class="w-full h-full bg-white border border-gray-300 rounded-lg focus:ring-primary-500 pl-9 dark:bg-zinc-900 dark:border-zinc-800"
                placeholder="Pesquisar amigo" type="search">
        </div>
    </div>
    @foreach ($receivedFriendRequests as $friend)
        <div
            class="flex w-full h-32 p-3 mb-3 overflow-hidden transition-all ease-in bg-white border border-gray-300 rounded-lg dark:bg-zinc-900 dark:border-zinc-800 lg:inline-block sm:h-44 lg:w-64 lg:h-auto lg:mr-1">
            <div class="w-2/4 lg:w-full">
                <img class="object-cover w-full h-full rounded-lg" src="{{ $friend->photo }}" alt="">
            </div>
            <div class="flex flex-col justify-between w-2/3 p-2 lg:w-full">
                <a wire:navigate href="{{ route('profile', ['nick' => $friend->nick]) }}"
                    class="flex flex-col w-full gap-1 transition-all ease-in group hover:text-primary-500 hover:underline">
                    {{ '@' . $friend->nick }}
                </a>
                <div class="flex justify-between gap-2 lg:flex-col lg:mt-3">
                    <x-primary-button class="flex items-center justify-between w-1/2 lg:w-full"
                        wire:click='acceptFriend({{ $friend->pivot->id }})'>
                        Aceitar
                        <div wire:loading wire:target='acceptFriend({{ $friend->pivot->id }})'>
                            <svg aria-hidden="true"
                                class="w-4 h-4 ml-2 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </x-primary-button>
                    <x-danger-button class="flex items-center justify-between w-1/2 lg:w-full"
                        wire:click='recuseFriend({{ $friend->pivot->id }})'>
                        Recusar
                        <div wire:loading wire:target='recuseFriend({{ $friend->pivot->id }})'>
                            <svg aria-hidden="true"
                                class="w-4 h-4 ml-2 text-gray-200 animate-spin dark:text-gray-600 fill-white"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </x-danger-button>
                </div>
                <span class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                    Enviado {{ Carbon::parse($friend->pivot->created_at)->diffForHumans() }}
                </span>
            </div>
        </div>
    @endforeach
    <div class="mt-6">
        {{ $receivedFriendRequests->links() }}
    </div>
</div>
