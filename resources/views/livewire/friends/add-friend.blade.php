<div>
    <x-primary-button wire:click='addFriend({{ $user_id }})'>
        {{ $text_button }}
        <div wire:loading wire:target='addFriend({{ $user_id }})'>
            <x-filament::loading-indicator class="w-5 h-5" />
        </div>
    </x-primary-button>
</div>
