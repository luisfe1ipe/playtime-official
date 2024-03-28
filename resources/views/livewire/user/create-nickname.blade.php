<div>
    <div class="relative w-full h-[500px] flex justify-center overflow-hidden">
        <div class="absolute bottom-0 w-full h-full from-zinc-950 bg-gradient-to-t z-[1]"></div>
        <div class="absolute inset-0 object-cover w-full h-full bg-center bg-no-repeat -z-0 brightness-50"
            style="background-image: url({{ $game->getImage($game->banner) }}); background-size: cover;">
        </div>
        <div class="px-6 lg:px-8 relative w-full h-full max-w-screen-xl z-[1]">
            <div class="flex flex-col justify-center h-full max-w-lg gap-8 text-white">
                <div class="flex flex-col gap-6">
                    <h1 class="text-4xl font-bold">Encontre seu time</h1>
                    <p class="text-lg">
                        Nosso sistema conecta jogadores de todo o Brasil para encontrar parceiros de equipe que
                        compartilham
                        suas habilidades e objetivos de jogo.
                    </p>
                </div>
                <div>
                    <a href="#" class="px-4 py-2 text-base font-semibold bg-primary-600 hover:bg-primary-700">
                        ANUNCIAR VAGA
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0">
        <div class="fixed inset-0 transition-all transform">
            <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
        </div>
        <div
            class="relative mb-6 transition-all transform rounded-lg shadow-xl bg-zinc-900 sm:w-full sm:max-w-2xl sm:mx-auto">
            <div class="p-6">
                <button class="absolute right-6 top-6" x-on:click="$dispatch('close')">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
                <h1 class="mb-2 text-xl font-bold">Adicione um nick</h1>
                <p class="text-gray-300">Antes de utilizar nossa plataforma, é necessário adicionar um nickname.</p>
                <form wire:submit.prevent='save'>
                    <div class="mt-4">
                        <x-input-label :required="true" :error="$errors->get('nick')" value="Nick" />
                        <x-text-input :error="$errors->get('nick')" wire:model='nick' placeholder="Digite aqui..." />
                        <x-input-error :messages="$errors->get('nick')" />
                    </div>
                    <div class="flex justify-end w-full">
                        <x-primary-button type='submit' class="mt-4">
                            Confirmar
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
