<div class="mt-12">
    <x-container>
        <h1>Escolha o Jogo</h1>
        <p class="my-4 text-lg">
            Por favor, escolha o jogo que você deseja jogar antes de prosseguir para encontrar um player.
        </p>
        {{-- <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"> --}}
            @foreach ($games as $game)
            <x-card-game :game="$game" />
            @endforeach
        </div>
    </x-container>
</div>