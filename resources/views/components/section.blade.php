@php
  $classes = 'bg-white shadow-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-900'
@endphp
<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
