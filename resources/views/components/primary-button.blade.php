<button {{$attributes->merge(['type' => 'submit', 'class' => 'flex gap-1 items-center focus:outline-none focus:ring-4
  font-medium rounded-lg
  text-sm px-5 py-2.5 bg-purple-600 hover:bg-purple-700
  focus:ring-purple-900'])}}>
  {{$slot}}
</button>