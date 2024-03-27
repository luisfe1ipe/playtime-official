@props(['text'])

<div class="flex items-center border rounded-lg border-zinc-700">
    <div class="w-full px-3 py-2 text-center rounded-l-lg bg-zinc-900">
        <p>{{ $text }}</p>
    </div>
    <div class="relative w-full text-center">
        <input wire:model='days_times_play.{{ $text }}.start' type="time"
            class="w-full border-none group bg-zinc-800 focus:ring-1 focus:ring-primary-500" />
        <div
            class="absolute inset-y-0 right-0 z-10 flex items-center px-3 pointer-events-none hover:cursor-pointer group-focus:border-primary-500 bg-zinc-800">
            <svg class="text-zinc-400 lucide lucide-clock" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
        </div>
    </div>
    <div class="w-full px-3 py-2 text-center bg-zinc-900">
        <p>as</p>
    </div>
    <div class="relative w-full text-center">
        <input type="time" wire:model='days_times_play.{{ $text }}.end'
            class="w-full border-none rounded-r-lg group bg-zinc-800 focus:ring-1 focus:ring-primary-500" />
        <div
            class="absolute inset-y-0 right-0 z-10 flex items-center px-3 rounded-r-lg pointer-events-none hover:cursor-pointer group-focus:border-primary-500 bg-zinc-800">
            <svg class="text-zinc-400 lucide lucide-clock" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
        </div>
    </div>
</div>
