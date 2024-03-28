<div>
    <x-container>
        <div class="grid grid-cols-8">
            <x-profile.info :user="$user" />
            <div class="w-full col-span-6 px-8 pt-24">
                <h1 class="text-4xl font-bold">Sobre</h1>
                <p class="text-gray-400">
                    Deixe que outras pessoas aprendam mais sobre sua equipe adicionando informações relevantes.
                </p>
                <form wire:submit.prevent='save' class="mt-6">
                    <h3 class="mb-6 text-xl font-bold">Informações</h3>

                </form>
            </div>
        </div>
    </x-container>
</div>
