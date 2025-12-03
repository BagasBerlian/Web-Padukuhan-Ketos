<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6 flex justify-end">
            <x-filament::button type="submit"
                size="lg">
                <x-filament::icon
                    icon="heroicon-m-check"
                    class="w-5 h-5 mr-2" />
                Simpan Profil Karang Taruna
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-filament-panels::page>