@props(['name', 'show' => false, 'maxWidth' => '2xl', 'title' => null])

@php
$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
'3xl' => 'sm:max-w-3xl',
'4xl' => 'sm:max-w-4xl',
'5xl' => 'sm:max-w-5xl',
][$maxWidth];
@endphp

<div x-data="{
    show: @js($show),
    focusables() {
        // All focusable element types...
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            // All non-disabled elements...
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})" x-on:close-modal.window="show = false" x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
  x-on:close.stop="show = false" x-on:keydown.escape.window="show = false"
  x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
  x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show"
  class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0" style="display: {{ $show ? 'block' : 'none' }};">
  <div x-show="show" class="fixed inset-0 transition-all transform" x-on:click="show = false"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
  </div>

  <div x-show="show"
    class="mb-6 bg-zinc-900 rounded-lg  shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
    <div class="space-y-2">
      <div class="flex items-center justify-between px-6 py-2">
        <h2 class="text-xl font-bold tracking-tight">
          {{ $title }}
        </h2>
        <button x-on:click="$dispatch('close')">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
        </button>
      </div>
      <div aria-hidden="true" class="px-2 border-t border-zinc-800"></div>
    </div>
    <div>
      {{ $slot }}
    </div>
  </div>
</div>