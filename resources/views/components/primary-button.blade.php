<button
    {{ $attributes->merge([
        'data-ripple-light' => 'true',
        'type' => 'submit',
        'class' => 'flex gap-1 items-center focus:outline-none text-white focus:ring-4
          font-medium rounded-lg
          text-sm px-5 py-2.5 bg-primary-600 hover:bg-primary-700
          focus:ring-primary-900',
    ]) }}>
    {{ $slot }}
</button>
