<div>
    <div class="relative w-full h-[500px]  flex justify-center overflow-hidden">
        <div class="absolute bottom-0 w-full h-full from-zinc-950 bg-gradient-to-t z-[1]"></div>
        <div class="absolute inset-0 object-cover w-full h-full bg-center bg-no-repeat -z-0 brightness-50"
            style="background-image: url({{ $game->getImage($game->banner) }}); background-size: co$ver;">
        </div>
        <div class="px-6 lg:px-8 relative w-full h-full max-w-screen-xl z-[1] ">
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
                    <a wire:navigate href="{{route('find-player.advertise-vacancy', ['slug' => $game->slug])}}"
                        class="px-4 py-2 text-base font-semibold bg-primary-600 hover:bg-primary-700">
                        ANUNCIAR VAGA
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-container>
        <div class="flex flex-col gap-4 text-2xl font-bold md:gap-0 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center w-full gap-2">
                <img class="object-contain size-16" src="{{ $game->getImage($game->photo) }}" alt="{{ $game->name }}">
                <h1 class="w-full">
                    {{ $game->name }}
                </h1>
            </div>
            <p class="w-full text-end">
                {{ $vacancies->total() }} Vagas disponíveis
            </p>
        </div>
        <div class="grid w-full grid-flow-row grid-cols-1 gap-6 mt-12 lg:grid-cols-2">
            @foreach ($vacancies as $v)
            <x-find-player.card :vacancy="$v"/>
            @endforeach
        </div>
        <div class="mt-12">
            {{$vacancies->links()}}
        </div>
    </x-container>
</div>