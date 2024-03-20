<div x-data="{open: false}" x-on:click.away="open = false" class="relative">
    <button type="button" x-on:click="open = !open;$nextTick(() => { $refs.inputSearch.focus(); })"
        class="flex items-center justify-between w-full h-12 px-4 transition duration-75 border rounded-lg shadow-sm outline-none border-zinc-700 focus:ring-1 focus:ring-inset disabled:opacity-70 bg-zinc-900 focus:ring-primary-500 focus:border-primary-500">
        @if ($item_select == null)
        <span class="text-zinc-400">
            Selecione uma opção
        </span>
        @else
        <div class="flex items-center w-full gap-4 rounded-lg">
            @php
            if($item_select->photo != null)
            {
            $item_select->image = $item_select->photo;
            }
            @endphp
            <img class="object-contain size-8" src="{{Storage::url($item_select->image)}}"
                alt="Imagem {{$item_select->name}}">
            <p class="truncate">
                {{$item_select->name}}
            </p>
        </div>
        @endif
        <div class="flex items-center">
            @if ($item_select != null)
            <div class="flex mr-2 text-zinc-400 hover:text-rose-500" type="button" wire:click.stop='unselectItem'>
                <svg class="size-5 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-circle-x">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m15 9-6 6" />
                    <path d="m9 9 6 6" />
                </svg>
            </div>
            @endif
            <svg wire:loading.remove wire:target='selectItem, unselectItem' class="size-5 text-zinc-400"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                <path d="m6 9 6 6 6-6" />
            </svg>
            <div wire:loading wire:target='selectItem, unselectItem'>
                <x-filament::loading-indicator class="w-5 h-5" />
            </div>
        </div>
    </button>
    <div x-show="open" x-cloak x-transition:enter="transition duration-300 ease-out transform"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition duration-200 ease-in transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="@if ($absolute == true)
            absolute
        @endif z-10 w-full px-2 py-2 mt-2 border rounded-lg shadow-lg shadow-black border-zinc-800 bg-zinc-900">
        <div class="p-2">
            <label for="input-group-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                    <svg wire:loading.remove wire:target='searchItem' class="w-4 h-4 text-gray-500 dark:text-gray-400"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <div wire:loading wire:target='searchItem'>
                        <x-filament::loading-indicator class="w-5 h-5" />
                    </div>
                </div>
                <x-text-input type="search" x-ref="inputSearch" wire:model.live='searchItem' placeholder="Digite aqui"
                    class="ps-10" />
            </div>
        </div>
        <div class="overflow-y-scroll max-h-36">
            @foreach ($items as $i)
            @php
            if($i->photo != null)
            {
            $i->image = $i->photo;
            }
            @endphp
            <button x-on:click="open = false" type="button" wire:click='selectItem({{$i->id}})'
                class="flex items-center w-full gap-4 p-2 rounded-lg cursor-pointer hover:bg-zinc-950/80">
                <img class="object-contain size-8" src="{{Storage::url($i->image)}}" alt="Imagem {{$i->name}}">
                <p>
                    {{$i->name}}
                </p>
            </button>
            @endforeach
        </div>
    </div>
</div>