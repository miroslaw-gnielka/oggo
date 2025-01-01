<x-dynamic-component
    :component="'filament-panels::page'"
>
    <x-filament-panels::form id="form" wire:submit="save">
        {{ $this->form }}

    </x-filament-panels::form>
</x-dynamic-component>
