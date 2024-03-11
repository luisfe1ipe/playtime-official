@props(['value', 'error' => null, 'required' => false])

@php
$errorClass = $error ? 'text-red-400' : '';
@endphp

<label {{ $attributes->merge(['class' => 'block font-medium text-sm mb-2 ' . $errorClass]) }}>
  {{ $value ?? $slot }}
  @if ($required)
    <span class="text-red-400">*</span>
  @endif
</label>