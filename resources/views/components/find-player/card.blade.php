@props(['vacancy'])
<a href="{{route('find-player.show', ['id' => $vacancy->id])}}"
  class="relative w-full px-4 py-4 transition-colors ease-linear border rounded-lg hover:bg-zinc-800 bg-zinc-900 border-zinc-800">
  <div class="absolute top-0 px-1 text-xs font-bold bg-primary-700 text-primary-300">
    {{ $vacancy->id }}
  </div>
  @if ($vacancy->game->has_characters)
  <div class="flex w-full gap-6">
    <div class="w-full">
      <img class="object-contain w-full h-20" src="{{$vacancy->character->getImage($vacancy->character->image)}}"
        alt="{{$vacancy->character->name}}">
    </div>
    <div>
      <p class="mb-1 text-base font-bold line-clamp-2">{{ $vacancy->title }}</p>
      <p class="text-sm line-clamp-3">
        {{ strip_tags($vacancy->description) }}
      </p>
    </div>
  </div>
  @else
  <div>
    <p class="mb-1 text-base font-bold line-clamp-2">{{ $vacancy->title }}</p>
    <p class="text-sm line-clamp-3">
      {{ strip_tags($vacancy->description) }}
    </p>
  </div>
  @endif
  <div class="flex items-center gap-4 mt-6">
    <div class="flex flex-col w-full gap-2">
      <span>Posição</span>
      <div class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
        <img class="object-contain size-8" src="{{$vacancy->position->getImage($vacancy->position->image)}}"
          alt="{{$vacancy->position->name}}">
        <p>{{$vacancy->position->name}}</p>
      </div>
    </div>
    <div class="flex flex-col w-full gap-2">
      <span>Rank minímo</span>
      <div class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
        <img class="object-contain h-8 w-14" src="{{$vacancy->rankMin->getImage($vacancy->rankMin->image)}}"
          alt="{{$vacancy->rankMin->name}}">
        <p class="truncate">{{$vacancy->rankMin->name}}</p>
      </div>
    </div>
    @if ($vacancy->rank_max_id)
    <div class="flex flex-col w-full gap-2">
      <span>Rank maxímo</span>
      <div class="flex items-center w-full gap-1 px-2 py-1 border rounded-lg bg-zinc-800 border-zinc-700">
        <img class="object-contain h-8 w-14" src="{{$vacancy->rankMax?->getImage($vacancy->rankMax->image)}}"
          alt="{{$vacancy->rankMax->name}}">
        <p class="truncate">{{$vacancy->rankMax->name}}</p>
      </div>
    </div>
    @endif
  </div>
</a>