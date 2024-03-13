<button {{$attributes->merge(['type' => 'submit', 'class' => 'flex gap-1 items-center border focus:ring-4
  focus:outline-none
  font-medium rounded-lg text-sm px-5 py-2.5 text-center border-zinc-600
  text-zinc-400 hover:text-white hover:bg-zinc-600 focus:ring-zinc-800'])}}>
  {{$slot}}
</button>