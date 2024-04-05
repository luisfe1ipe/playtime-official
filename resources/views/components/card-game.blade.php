@props([
    'game' => null,
])

<a wire:navigate href="{{ route('find-player.index', ['slug' => $game->slug]) }}"
    class="relative flex flex-col items-center w-full h-64 overflow-hidden text-center duration-200 ease-in rounded-md shadow-md cursor-pointer shadow-gray-300 dark:shadow-black hover:shadow-xl sm:w-60 sm:h-96 group">
    <div class="absolute bottom-0 w-full h-1/2 from-gray-950/50 group-hover:bg-gradient-to-t z-[1] ">

    </div>
    <img class=" w-full h-full object-cover group-hover:brightness-[65%] ease-in duration-200 group-hover:scale-110"
        src="{{ $game->getImage($game->alternative_photo) }}" alt="Imagem {{ $game->name }}">
    <div class="absolute group-hover:bottom-4 ease-in duration-200 -bottom-12 z-[2]">
        <h2 class="text-white">{{ $game->name }}</h2>
    </div>
</a>
