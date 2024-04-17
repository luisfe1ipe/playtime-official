@use('Carbon\Carbon')

<div wire:key="{{ $notification->id }}"
    class="flex items-center w-full gap-4 p-2 transition-colors ease-linear rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-950/80">
    <div class="flex w-full gap-1">
        <div
            class="flex items-center justify-center p-2 text-gray-400 bg-gray-200 rounded-full size-10 dark:text-zinc-300 dark:bg-zinc-700">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake">
                <path d="m11 17 2 2a1 1 0 1 0 3-3" />
                <path
                    d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4" />
                <path d="m21 3 1 11h-2" />
                <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3" />
                <path d="M3 4h8" />
            </svg>
        </div>
        <div class="w-full">
            <div class="text-sm">
                <p>
                    {{ $notification->data['message'] }}
                </p>
            </div>
            <span class="text-xs text-gray-400">
                {{ Carbon::parse($notification->created_at)->diffForHumans() }}
            </span>
            <div class="flex justify-end gap-1">
                @if ($notification->read_at != null)
                    <button wire:click="deleteNotification('{{ $notification->id }}')"
                        class="flex items-center gap-1 px-2 py-1 text-xs text-white rounded-lg bg-rose-700 hover:bg-rose-600">
                        apagar
                        <div wire:loading wire:target='deleteNotification("{{ $notification->id }}")'>
                            <x-filament::loading-indicator class="size-4" />
                        </div>
                    </button>
                @else
                    <button wire:click="readNotification('{{ $notification->id }}')"
                        class="flex items-center gap-1 px-2 py-1 text-xs bg-gray-200 rounded-lg hover:bg-gray-300/50 dark:bg-zinc-800 dark:hover:bg-zinc-700">
                        marcar como lido
                        <div wire:loading wire:target='readNotification("{{ $notification->id }}")'>
                            <x-filament::loading-indicator class="size-4" />
                        </div>
                    </button>
                @endif
                <a wire:navigate href="{{ route('friends.friendship-requests') }}"
                    class="px-2 py-1 text-xs text-white rounded-lg bg-primary-600 hover:bg-primary-500">
                    visualizar
                </a>
            </div>
        </div>
    </div>
</div>
