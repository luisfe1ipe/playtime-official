@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm mb-2']) }}>
  {{ $value ?? $slot }}
</label>