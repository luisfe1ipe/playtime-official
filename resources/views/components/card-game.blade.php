@props([
'game' => null,
])

<a
  class="text-center cursor-pointer hover:shadow-xl ease-in duration-200 rounded-md border-[1.5px] border-transparent w-full h-64 sm:w-60 sm:h-96 group overflow-hidden flex flex-col items-center relative">
  <div class="absolute bottom-0 w-full h-1/2 from-gray-950/50 group-hover:bg-gradient-to-t z-[1] ">

  </div>
  <img class=" w-full h-full object-cover group-hover:brightness-[65%] ease-in duration-200 group-hover:scale-110"
    src="{{ Storage::url($game->alternative_photo) }}" alt="Imagem {{$game->name}}">
  <div class="absolute group-hover:bottom-4 ease-in duration-200 -bottom-12 z-[2]">
    <h2>{{ $game->name }}</h2>
  </div>
</a>