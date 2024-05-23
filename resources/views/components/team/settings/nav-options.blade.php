@props(['team' => $team, 'active' => ''])
<div class="sticky top-0 flex flex-col items-center w-full h-screen col-span-2 pt-24">
    <div class="flex flex-col items-center w-full">
        <div
            class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-900 rounded-md relative  flex flex-col justify-center items-center">
            @if ($team->image)
                <img class="object-cover w-full h-full rounded-md" src="{{ Storage::url($team->image) }}"
                    alt="Foto {{ $team->name }}">
            @else
                <svg class="text-zinc-600 size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users-round">
                    <path d="M18 21a8 8 0 0 0-16 0" />
                    <circle cx="10" cy="8" r="5" />
                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                </svg>
            @endif
        </div>
        <h3 class="mt-2">{{ $team->name }}</h3>
    </div>
    <nav class="w-full px-10 mt-6">
        <ul class="flex flex-col w-full gap-1 font-bold">
            @if (auth()->user()->id === $team->user->id)
                <li class="w-full">
                    <a wire:navigate href="{{route('my-teams.settings.about', ['slug' => $team->slug])}}" @if ($active == 'about')
                        class="flex items-center w-full gap-1 p-2 rounded-md bg-zinc-800 hover:bg-zinc-800"
                    @else
                        class="flex items-center w-full gap-1 p-2 border rounded-md border-zinc-700 hover:bg-zinc-800"
            @endif>
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-info">
                <circle cx="12" cy="12" r="10" />
                <path d="M12 16v-4" />
                <path d="M12 8h.01" />
            </svg>
            Sobre
            </a>
            </li>
            <li>
                <a wire:navigate href="{{route('my-teams.settings.appearance', ['slug' => $team->slug])}}" @if ($active == 'appearance')
                    class="flex items-center w-full gap-1 p-2 rounded-md bg-zinc-800 hover:bg-zinc-800"
                @else
                    class="flex items-center w-full gap-1 p-2 border rounded-md border-zinc-700 hover:bg-zinc-800"
                    @endif
                    >
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-brush">
                        <path d="m9.06 11.9 8.07-8.06a2.85 2.85 0 1 1 4.03 4.03l-8.06 8.08" />
                        <path
                            d="M7.07 14.94c-1.66 0-3 1.35-3 3.02 0 1.33-2.5 1.52-2 2.02 1.08 1.1 2.49 2.02 4 2.02 2.2 0 4-1.8 4-4.04a3.01 3.01 0 0 0-3-3.02z" />
                    </svg>
                    Aparência
                </a>
            </li>
            @endif
            <li>
                <a wire:navigate href="{{route('my-teams.settings.members', ['slug' => $team->slug])}}" @if ($active == 'members')
                    class="flex items-center w-full gap-1 p-2 rounded-md bg-zinc-800 hover:bg-zinc-800"
                @else
                    class="flex items-center w-full gap-1 p-2 border rounded-md border-zinc-700 hover:bg-zinc-800"
                    @endif>
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                    Membros
                </a>
            </li>
        </ul>
        {{-- @if ($team->members->count() > 0)
                    <button x-on:click.prevent="$dispatch('open-modal', 'quit-team');"
                        class="mt-6 w-full py-2 rounded-full transition ease-linear border-[1.5px] border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-white">
                        Sair do time
                    </button>
                    @endif --}}
        @if ($team->user->id === auth()->user()->id)
            <button x-on:click.prevent="$dispatch('open-modal', 'delete-team');"
                class="mt-4
                                    w-full py-2 rounded-full transition ease-linear border-[1.5px] border-rose-500 text-rose-500
                                    hover:bg-rose-500 hover:text-white">
                Excluir time
            </button>
        @endif
    </nav>
</div>
