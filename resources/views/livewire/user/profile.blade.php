<div>
    <x-container>
        <div class="h-[400px] relative"
            style="background-image: url({{ $user->getImage($user->banner) }}); background-size: cover;">
            @if ($user->id === Auth::user()->id)
            <div class="absolute top-4 right-6 z-[1]">
                <button x-on:click.prevent="$dispatch('open-modal', 'edit-banner')"
                    class="flex items-center gap-2 px-4 py-1 transition ease-linear border rounded-md bg-zinc-800 border-zinc-700 hover:bg-zinc-700">
                    <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-camera">
                        <path
                            d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                        <circle cx="12" cy="13" r="3" />
                    </svg>
                    Atualizar banner
                </button>
            </div>
            @endif
            <div class="absolute w-full h-full from-zinc-950 bg-gradient-to-t bottom-20">

            </div>
            <div class="absolute bottom-0 w-full h-1/5 bg-zinc-950 from-zinc-950 bg-gradient-to-t z-[1]"></div>
            <div class="absolute bottom-0 w-full max-w-7xl mx-auto px-6 lg:px-8 z-[1]">
                <div class="flex items-end w-full gap-8">
                    <div
                        class="min-w-[10rem]  min-h-[10rem] max-w-[10rem] max-h-[10rem] bg-zinc-800 rounded-md relative  flex flex-col justify-center items-center">
                        <img class="object-cover w-full h-full rounded-md" src="{{ $user->getImage($user->photo) }}"
                            alt="Imagem {{$user->name}}">
                        <svg class="size-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-users-round">
                            <path d="M18 21a8 8 0 0 0-16 0" />
                            <circle cx="10" cy="8" r="5" />
                            <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                        </svg>
                        @if ($user->id === Auth::user()->id)
                        <button type="button" x-on:click.prevent="$dispatch('open-modal', 'edit-photo')"
                            class="absolute bottom-0 flex flex-col items-center justify-center w-10 h-10 transition-all ease-linear border-2 rounded-full cursor-pointer border-zinc-700 bg-zinc-800 hover:bg-zinc-700 -right-3 ">
                            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-camera">
                                <path
                                    d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                                <circle cx="12" cy="13" r="3" />
                            </svg>
                        </button>
                        @endif
                    </div>
                    <div>
                        <h2>{{$user->name}}</h2>
                        <h4 class="font-semibold text-primary-500">{{'@'.$user->nick}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>