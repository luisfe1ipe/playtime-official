<div>
    <form wire:submit.prevent='create' class="p-6">
        <div>
            {{ $this->form }}
        </div>
        <div class="flex items-center justify-end w-full gap-6 mt-6">
            <x-filament::button outlined color="gray" type="button" x-on:click="$dispatch('close-modal')">
                Cancelar
            </x-filament::button>
            <x-primary-button type="submit">
                Confirmar
            </x-primary-button>
        </div>
    </form>
</div>