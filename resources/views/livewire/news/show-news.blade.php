<div>
    <div class="relative w-full h-[500px]  flex justify-center">
        <div class="absolute bottom-0 w-full h-1/2 from-zinc-950 bg-gradient-to-t z-[1]">

        </div>
        <img class="absolute inset-0 object-cover w-full h-full bg-center bg-no-repeat -z-0 brightness-50"
            src="{{ $news->image }}" />
    </div>
    <x-container>
        <div class="relative -top-32 z-[1] bg-zinc-950">
            <div class="pt-2 border-l-4 border-primary-500">
                <div class="flex flex-col gap-3 ml-4 ">
                    <h1 class="text-3xl font-bold">{{ $news->title }}</h1>
                    <h3 class="text-lg">{{ $news->subtitle }}</h3>
                    <div class="flex items-center gap-6">
                        <div class="px-4 py-1 text-white" style="background: {{ $news->type->color }}">
                            {{ $news->type->name }}
                        </div>
                        <span class="text-sm text-gray-400">Por <strong class="text-primary-500">{{
                                $news->user->name
                                }}</strong>,
                            {{ date('d/m/Y', strtotime($news->created_at)) }} - {{$news->views}} visualizações</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-6 mt-12 text-lg custom-ul">
                {!! $news->text !!}
            </div>
            <div class="mt-12">
                <a href="#" class="relative flex items-center gap-6 group">
                    <img class="w-32 rounded-full" src="{{ Storage::url($news->user->photo) }}"
                        alt="{{ $news->user->name }}">
                    <div class="flex flex-col gap-3">
                        <p class="text-xl group-hover:text-primary-500">
                            <strong>
                                {{ $news->user->name }}
                            </strong>
                            @if($news->user->nick)
                            #
                            {{ $news->user->nick}}
                            @endif
                        </p>
                        <span>Membro desde: {{ date('d/m/Y', strtotime($news->user->created_at)) }}</span>
                    </div>
                </a>
            </div>
            <div class="mt-12">
                <h1 class="mb-8 text-3xl font-bold">Últimas noticias</h1>
                <div class="grid grid-cols-2 gap-y-12 gap-x-6 lg:gap-6 lg:grid-cols-4">
                    @foreach ($recentNews as $n)
                    <a href="{{route('news.show', $n->id)}}" class="group">
                        <div class="w-full transition ease-in delay-100 group-hover:scale-105 h-36">
                            <img class="object-cover w-full h-full rounded-md" src="{{ $n->image }}" alt="">
                            <p class="mt-2 text-center truncate">
                                {{ $n->title }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-container>
</div>