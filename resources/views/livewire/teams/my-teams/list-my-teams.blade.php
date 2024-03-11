<div>
    <x-container>
        <div class="flex items-center justify-between mt-12">
            <h1>
                Meus Times
            </h1>
            {{-- @if (!$myTeamsLeader->isEmpty() || !$myTeamsMember->isEmpty())

            @endif --}}
            <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'create-team')">
                Criar time
            </x-primary-button>
            <x-modal maxWidth='xl' name="create-team" title="Criar Time">
                <form wire:submit.prevent='submit'>
                    <div class="p-2 space-y-2">
                        <div class="px-4 py-2 space-y-4">
                            <x-input-label :required="true" :error="$errors->get('name')" value="Nome" />
                            <x-text-input :error="$errors->get('name')" wire:model='name' disabled=""
                                placeholder="Digite aqui..." />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div aria-hidden="true" class="px-2 border-t border-zinc-800"></div>

                        <div class="px-6 py-2">
                            <div class="flex flex-wrap items-center gap-4">
                                <x-primary-button type='submit'>
                                    Confirmar
                                </x-primary-button>
                                {{-- <x-secondary-button x-on:click="$dispatch('close')"> --}}
                                    {{-- Cancelar --}}
                                    {{-- </x-secondary-button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </x-modal>
        </div>
        <div>
            @foreach ($myTeams as $tl)
            <a href="#" class="inline-flex flex-col items-center gap-2 mx-4 my-6 cursor-pointer group">
                <div
                    class="flex items-center justify-center w-32 h-32 overflow-hidden transition-all ease-linear rounded-full bg-zinc-800 group-hover:bg-zinc-800/50">
                    @if ($tl->image === null)
                    <svg class="text-gray-300 size-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-users-round">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                    @else
                    <img src="{{ Storage::url($tl->image) }}"
                        class="object-cover w-full h-full transition-all ease-linear group-hover:brightness-90"
                        alt="{{ $tl->name }}">
                    @endif
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold transition-all ease-linear group-hover:text-primary-500">
                        {{ $tl->name }}</p>
                    <span class="text-gray-500">membros</span>
                </div>
            </a>
            @endforeach
        </div>
        <h1 class="mt-6">Times que sou membro</h1>
    </x-container>
</div>