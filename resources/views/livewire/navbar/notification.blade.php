<div x-data="{notification: false}" class="flex items-center gap-6">
    @use('Carbon\Carbon')
    <div class="relative" x-on:click.outside="notification = false">
        <button x-on:click.stop="notification = !notification" class="relative group">
            <div
                class="absolute flex items-center justify-center p-2 text-xs font-bold rounded-full -right-1 -top-[6px] size-3 text-primary-300 bg-primary-700">
                {{$notifications->count()}}
            </div>
            <svg class="text-gray-200 size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
        </button>
        <div x-show="notification" x-cloak x-transition:enter="transition duration-300 ease-out transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-200 ease-in transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 z-10 px-2 py-2 mt-2 border rounded-lg shadow-lg w-80 shadow-black border-zinc-800 bg-zinc-900">
            <div>
                <div class="flex items-center w-full gap-4 border-b border-zinc-800">
                    <button
                        class="@if($viewNotifications == 'new') text-primary-500 font-bold border-b-2 border-primary-500
                                        @endif pb-2 text-gray-400 hover:text-primary-500 hover:border-primary-500 hover:border-b-2 hover:font-bold transition-all ease-out"
                        wire:click="$set('viewNotifications', 'new')">
                        Novas
                    </button>
                    <button
                        class="@if($viewNotifications == 'read') text-primary-500 font-bold border-b-2 border-primary-500
                                        @endif pb-2 text-gray-400 hover:text-primary-500 hover:border-primary-500 hover:border-b-2 hover:font-bold transition-all ease-out"
                        wire:click="$set('viewNotifications', 'read')">
                        Lidas
                    </button>
                </div>
                <div class="py-2 overflow-y-scroll max-h-72">
                    @if ($viewNotifications == 'new')
                    @forelse ($notifications as $n)
                    <div wire:key="{{$n}}"
                        class="flex items-center w-full gap-4 p-2 rounded-lg cursor-pointer hover:bg-zinc-950/80">
                        <div class="flex w-full gap-1">
                            <img class="rounded-full size-10" src="{{$n->data['user_registered']['photo']}}"
                                alt="Foto {{$n->data['user_registered']['name']}}">
                            <div class="w-full">
                                <div class="flex items-start gap-1 text-sm">
                                    <a class="text-primary-400 hover:underline">
                                        {{"@".$n->data['user_registered']['nick']}}
                                    </a>
                                    <p>
                                        {{$n->data['message']}}
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{Carbon::parse($n->created_at)->diffForHumans()}}
                                </span>
                                <div class="flex justify-end gap-1">
                                    <button wire:click="readNotification('{{$n->id}}')"
                                        class="flex items-center gap-1 px-2 py-1 text-xs rounded-lg bg-zinc-800 hover:bg-zinc-700">
                                        marcar como lido
                                        <div wire:loading wire:target='readNotification("{{$n->id}}")'>
                                            <x-filament::loading-indicator class="size-4" />
                                        </div>
                                    </button>
                                    <a wire:navigate
                                        href="{{route('find-player.show', ['id' => $n->data['find_player']['id']])}}"
                                        class="px-2 py-1 text-xs rounded-lg bg-primary-600 hover:bg-primary-500">
                                        visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-400">
                        Você não possui nenhuma notificação.
                    </p>
                    @endforelse
                    @else
                    @forelse ($readNotifications as $rn)
                    <div wire:key="{{$rn}}"
                        class="flex items-center w-full gap-4 p-2 rounded-lg cursor-pointer hover:bg-zinc-950/80">
                        <div class="flex w-full gap-1">
                            <img class="rounded-full size-10" src="{{$rn->data['user_registered']['photo']}}"
                                alt="Foto {{$rn->data['user_registered']['name']}}">
                            <div class="w-full">
                                <div class="flex items-start gap-1 text-sm">
                                    <a class="text-primary-400 hover:underline">
                                        {{"@".$rn->data['user_registered']['nick']}}
                                    </a>
                                    <p>
                                        se inscreveu em sua vaga.
                                    </p>
                                </div>
                                <span class="text-xs text-gray-400">
                                    {{Carbon::parse($rn->created_at)->diffForHumans()}}
                                </span>
                                <div class="flex justify-end gap-1">
                                    <button wire:click="deleteNotification('{{$rn->id}}')"
                                        class="flex items-center gap-1 px-2 py-1 text-xs rounded-lg bg-rose-700 hover:bg-rose-600">
                                        apagar
                                        <div wire:loading wire:target='deleteNotification("{{$rn->id}}")'>
                                            <x-filament::loading-indicator class="size-4" />
                                        </div>
                                    </button>
                                    <a wire:navigate
                                        href="{{route('find-player.show', ['id' => $rn->data['find_player']['id']])}}"
                                        class="px-2 py-1 text-xs rounded-lg bg-primary-600 hover:bg-primary-500">
                                        visualizar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-400">
                        Você não possui nenhuma notificação lida.
                    </p>
                    @endforelse
                    @endif
                </div>
                <div class="flex items-center justify-between gap-4 pt-4 border-t border-zinc-800">
                    @if (!$notifications->isEmpty())
                    <button wire:click='readAllNotifications'
                        class="flex items-center w-full gap-1 text-xs text-gray-400 hover:underline">
                        marcar todas como lido
                        <div wire:loading wire:target='readAllNotifications'>
                            <x-filament::loading-indicator class="size-4" />
                        </div>
                    </button>
                    @endif
                    @if($viewNotifications == 'read' && !$readNotifications->isEmpty())
                    <button wire:click='deleteAllNotifications'
                        class="flex items-center w-full gap-1 text-xs text-red-400 hover:underline">
                        apagar todas
                        <div wire:loading wire:target='deleteAllNotifications'>
                            <x-filament::loading-indicator class="size-4" />
                        </div>
                    </button>
                    @endif
                    <a wire:navigate href="{{route('notifications.index')}}" class="w-full text-xs text-end text-primary-500 hover:underline">
                        visualizar todas
                    </a>
                </div>
            </div>
        </div>
    </div>
    <button class="flex items-center gap-2">
        <div class="overflow-hidden text-center rounded-full w-14 h-14 bg-primary-500">
            <img class="w-full h-full" src="{{Auth::user()->photo}}" alt="Foto perfil">
        </div>
        <div class="flex items-end">
            <p>{{Auth::user()->name}}</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-down">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </div>
    </button>
</div>