@use('Carbon\Carbon')

<div wire:key="{{$notification->id}}"
  class="flex items-center w-full gap-4 p-2 rounded-lg cursor-pointer hover:bg-zinc-950/80">
  <div class="flex w-full gap-1">
    <img class="rounded-full size-10" src="{{$notification->data['user_registered']['photo']}}"
      alt="Foto {{$notification->data['user_registered']['name']}}">
    <div class="w-full">
      <div class="flex items-start gap-1 text-sm">
        <a href="#" class="text-primary-400 hover:underline">
          {{"@".$notification->data['user_registered']['nick']}}
        </a>
        <p>
          {{$notification->data['message']}}
        </p>
      </div>
      <span class="text-xs text-gray-400">
        {{Carbon::parse($notification->created_at)->diffForHumans()}}
      </span>
      <div class="flex justify-end gap-1">
        @if($notification->read_at != null)
        <button wire:click="deleteNotification('{{$notification->id}}')"
          class="flex items-center gap-1 px-2 py-1 text-xs rounded-lg bg-rose-700 hover:bg-rose-600">
          apagar
          <div wire:loading wire:target='deleteNotification("{{$notification->id}}")'>
            <x-filament::loading-indicator class="size-4" />
          </div>
        </button>
        @else
        <button wire:click="readNotification('{{$notification->id}}')"
          class="flex items-center gap-1 px-2 py-1 text-xs rounded-lg bg-zinc-800 hover:bg-zinc-700">
          marcar como lido
          <div wire:loading wire:target='readNotification("{{$notification->id}}")'>
            <x-filament::loading-indicator class="size-4" />
          </div>
        </button>
        @endif
        <a wire:navigate href="{{route('find-player.show', ['id' => $notification->data['find_player']['id']])}}"
          class="px-2 py-1 text-xs rounded-lg bg-primary-600 hover:bg-primary-500">
          visualizar
        </a>
      </div>
    </div>
  </div>
</div>