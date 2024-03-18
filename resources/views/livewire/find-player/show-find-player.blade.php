<div>
    @use('App\Enums\FindPlayerStatus')

    <x-container>
        <nav class="flex mt-6 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-end space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li>
                    <div class="flex items-center">
                        <a wire:navigate href="{{route('find-player.index', ['slug' => $vacancy->game->slug])}}"
                            class="text-sm font-medium text-gray-400 ms-1 hover:text-primary-500 md:ms-2">Encontrar
                            player</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">Visualizar
                            vaga</span>
                    </div>
                </li>
            </ol>
        </nav>
        @if(Auth::user()->id == $vacancy->user->id)
        <div class="flex justify-end w-full gap-8 mb-12">
            <x-danger-button x-on:click="$dispatch('open-modal', 'delete-vacancy')">
                Excluir vaga
            </x-danger-button>
            <x-secondary-button wire:click='active'>
                @if ($vacancy->active)
                Desativar vaga
                @else
                Ativar vaga
                @endif
            </x-secondary-button>
            <a wire:navigate href="{{route('find-player.edit', ['id' => $vacancy->id])}}"
                class="flex gap-1 items-center focus:outline-none focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 bg-primary-600 hover:bg-primary-700 focus:ring-primary-900">
                Editar vaga
            </a>
        </div>
        @endif
        <div class="flex w-full gap-6">
            <div class="w-3/5">
                <h1 class="mb-6">Detalhes da vaga</h1>
                <div
                    class="relative px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                    <div class="absolute top-0 px-1 text-xs font-bold bg-primary-700 text-primary-300">
                        {{ $vacancy->id }}
                    </div>
                    @if ($vacancy->game->has_characters)
                    <div class="flex w-full gap-6">
                        <div>
                            <img class="object-contain max-w-20 max-h-20"
                                src="{{$vacancy->character->getImage($vacancy->character->image)}}"
                                alt="{{$vacancy->character->name}}">
                        </div>
                        <div>
                            <p class="mb-3 text-lg font-bold">{{ $vacancy->title }}</p>
                            <p class="text-base">
                                {{ strip_tags($vacancy->description) }}
                            </p>
                        </div>
                    </div>
                    @else
                    <div>
                        <p class="mb-3 text-lg font-bold">{{ $vacancy->title }}</p>
                        <p class="text-base">
                            {{ strip_tags($vacancy->description) }}
                        </p>
                    </div>
                    @endif
                    <div class="flex items-center gap-4 mt-6">
                        <div class="flex flex-col w-full gap-2">
                            <span>Posição</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain size-8"
                                    src="{{$vacancy->position->getImage($vacancy->position->image)}}"
                                    alt="{{$vacancy->position->name}}">
                                <p>{{$vacancy->position->name}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col w-full gap-2">
                            <span>Rank minímo</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain h-8 w-14"
                                    src="{{$vacancy->rankMin->getImage($vacancy->rankMin->image)}}"
                                    alt="{{$vacancy->rankMin->name}}">
                                <p class="truncate">{{$vacancy->rankMin->name}}</p>
                            </div>
                        </div>
                        @if ($vacancy->rank_max_id)
                        <div class="flex flex-col w-full gap-2">
                            <span>Rank maxímo</span>
                            <div
                                class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
                                <img class="object-contain h-8 w-14"
                                    src="{{$vacancy->rankMax->getImage($vacancy->rankMax->image)}}"
                                    alt="{{$vacancy->rankMax->name}}">
                                <p class="truncate">{{$vacancy->rankMax->name}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="flex justify-end w-full mt-4">
                        @if($this->vacancy->findPlayerMembers->contains(Auth::user()->id))
                        <x-danger-button wire:click='unsubscribe'>
                            Cancelar candidatura
                            <div class="ml-2" wire:loading wire:target='unsubscribe'>
                                <x-filament::loading-indicator class="w-5 h-5" />
                            </div>
                        </x-danger-button>
                        @else
                        <x-primary-button wire:click='signUp'>
                            Candidatar-se
                            <div class="ml-2" wire:loading wire:target='signUp'>
                                <x-filament::loading-indicator class="w-5 h-5" />
                            </div>
                        </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-2/5 gap-8">
                <div>
                    <h1 class="mb-6">Informações adicionais</h1>
                    <div class="px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="mb-1 text-lg font-bold">Jogo</p>
                                <div class="flex items-center gap-3">
                                    <img class="rounded-full size-12"
                                        src="{{$vacancy->game->getImage($vacancy->game->photo)}}"
                                        alt="Foto {{$vacancy->game->name}}">
                                    <p class="text-base">{{$vacancy->game->name}}</p>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-lg font-bold">Anunciada em</p>
                                <p class="text-base">{{$vacancy->created_at}}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <div>
                                <p class="mb-1 text-lg font-bold">Usuários inscritos</p>
                                <div class="flex items-center gap-3">
                                    <p class="text-base">colocar aqui.</p>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-lg font-bold">Status</p>
                                @if ($vacancy->active)
                                <span
                                    class="text-sm font-medium tracking-wider  px-2.5 py-0.5 rounded bg-green-900 text-green-300">Ativo</span>
                                @else
                                <span
                                    class="tracking-wider ext-sm font-medium me-2 px-2.5 py-0.5 rounded bg-red-900 text-red-300">Fechado</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h1 class="mb-6">Anunciada por</h1>
                    <div class="px-4 py-4 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                        <div class="flex w-full gap-6">
                            <img class="rounded-full size-24" src="{{$vacancy->user->getImage($vacancy->user->photo)}}"
                                alt="Foto {{$vacancy->user->name}}">
                            <div class="flex flex-col gap-1">
                                <h3>{{$vacancy->user->name}}</h3>
                                <a class="text-primary-300 hover:underline" href="#" target="_blank">Visualizar
                                    perfil</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->id === $vacancy->user_id)
        <div class="mt-12">
            <h1>Usuários Inscritos</h1>
            <p class="mt-1 text-lg text-gray-300">
                Lembre-se de que ao aceitar ou recusar um usuário, um e-mail será enviado a ele para informá-lo sobre
                sua decisão.
            </p>
            <p class="text-lg text-gray-300">
                Depois de selecionar um usuário, você pode adicioná-lo como amigo e iniciar uma conversa dentro da
                plataforma. Você
                também tem a opção de adicioná-lo em outra rede social, basta acessar o perfil do usuário para
                visualizar suas redes
                sociais.
            </p>
            <div
                class="relative flex flex-col gap-12 px-4 py-4 mt-6 transition-colors ease-linear border rounded-lg bg-zinc-900 border-zinc-800">
                @forelse ($registeredUsers as $m)
                <div class="flex items-center justify-between p-4 rounded-lg hover:bg-zinc-950/50">
                    <div class="flex items-center gap-4">
                        <img class="rounded-lg size-14" src="{{$m->getImage($m->photo)}}" alt="Foto {{$m->nick}}">
                        <div>
                            <p class="text-lg font-medium">{{$m->name}}</p>
                            <a target="_blank" href="#"
                                class="font-medium text-primary-400 hover:underline">{{"@$m->nick"}}</a>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p class="text-lg font-medium">Candidatou-se em</p>
                            <p>{{$m->pivot->created_at}}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($m->pivot->status === FindPlayerStatus::ACCEPTED->value)
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aceito</span>
                        @elseif($m->pivot->status === FindPlayerStatus::REJECTED->value)
                        <span
                            class="bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Recusado</span>
                        @else
                        <span
                            class="bg-orange-100 text-orange-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">Pendente</span>
                        @endif
                        <div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false"
                            class="relative">
                            <div x-on:click="open = ! open"
                                class="p-1 transition-all ease-linear rounded-full cursor-pointer hover:bg-zinc-700 group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                </svg>
                            </div>
                            <div x-show="open" x-cloak
                                class="absolute z-[10] font-medium w-52 rounded-md bg-zinc-900 border border-zinc-800 shadow-lg right-0"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95">
                                <ul class="flex flex-col gap-1 p-2 text-sm">
                                    <li>
                                        <button type="button" wire:click="acceptUser({{$m->id}})"
                                            class="flex items-center w-full gap-2 p-2 transition-all ease-linear rounded-md cursor-pointer hover:bg-zinc-950">
                                            <svg class="font-bold text-green-600 size-5 group-hover:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="3" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                            <p>
                                                Aceitar
                                            </p>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" wire:click="refuseUser({{$m->id}})"
                                            class="flex items-center w-full gap-2 p-2 transition-all ease-linear rounded-md cursor-pointer hover:bg-zinc-950">
                                            <svg class="font-bold text-rose-600 size-5 group-hover:text-white"
                                                stroke-width="3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            <p>
                                                Recusar
                                            </p>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex items-center justify-center h-full gap-3">
                    <svg class="size-24 text-primary-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm-4.34 7.964a.75.75 0 0 1-1.061-1.06 5.236 5.236 0 0 1 3.73-1.538 5.236 5.236 0 0 1 3.695 1.538.75.75 0 1 1-1.061 1.06 3.736 3.736 0 0 0-2.639-1.098 3.736 3.736 0 0 0-2.664 1.098Z"
                            clip-rule="evenodd" />
                    </svg>
                    <h2>
                        Infelizmente ainda não há usuários inscritos.
                    </h2>
                </div>
                @endforelse
                <div>
                    {{ $registeredUsers->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
        </div>
        @endif
        <x-delete-modal function="delete" text="Tem certeza que deseja excluir esta vaga ?"
            subtext="Ao excluir a vaga todos os usuários inscritos serão perdidos!" name="delete-vacancy" />
    </x-container>
</div>