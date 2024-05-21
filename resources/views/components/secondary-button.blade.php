<button
    {{ $attributes->merge([
        'data-ripple-light' => 'true',
        'type' => 'submit',
        'class' => 'flex gap-1 items-center border focus:ring-4
          focus:outline-none
          font-medium bg-zinc-900 text-white rounded-lg text-sm px-5 py-2.5 text-center border-zinc-700 hover:text-white
          hover:bg-zinc-800 focus:ring-zinc-800',
    ]) }}>
    {{ $slot }}
</button>
