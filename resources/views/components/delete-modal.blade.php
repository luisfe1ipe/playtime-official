@props([
'name',
'show' => false,
'maxWidth' => '2xl',
'title' => null,
'function' => null,
'text' => ' Tem certeza que deseja excluir ?',
'subtext' => null
])

@php
$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
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
})" x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null" x-on:close.stop="show = false"
  x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
  x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show"
  class="fixed inset-0 z-50 px-4 py-6 overflow-y-auto sm:px-0" style="display: {{ $show ? 'block' : 'none' }};">
  <div x-show="show" class="fixed inset-0 transition-all transform" x-on:click="show = false"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 cursor-pointer bg-black/60"></div>
  </div>

  <div x-cloak x-show="show"
    class="mb-6 bg-zinc-900 text-gray-100 rounded-lg  shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
    <div class="relative rounded-lg shadow">
      <form wire:submit.prevent='{{ $function }}'>
        <button type="button" x-on:click="$dispatch('close')"
          class="absolute top-3 right-2.5 text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center hover:bg-zinc-700 hover:text-white"
          data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-6 text-center">
          <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="text-lg font-normal ">
            {{ $text }}
          </h3>
          @if ($subtext != null)
          <p class="mt-2 text-gray-300">
            {{ $subtext }}
          </p>
          @endif
          <div class="flex items-center justify-center gap-6 mt-6">
            <x-danger-button type="submit" x-on:click="$dispatch('close')"
              class="text-white bg-rose-500 hover:bg-rose-700 focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-700 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
              Sim, tenho certeza
            </x-danger-button>
            <x-secondary-button x-on:click="$dispatch('close')" type="button">
              Não, cancelar
            </x-secondary-button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>