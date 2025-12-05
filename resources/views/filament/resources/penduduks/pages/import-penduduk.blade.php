<x-filament-panels::page>
    <form wire:submit="import">
        {{ $this->form }}

        <div class="mt-6 flex gap-3 justify-end">
            <x-filament::button color="gray"
                tag="a"
                :href="route('filament.admin.resources.penduduks.index')">
                Batal
            </x-filament::button>

            <x-filament::button type="submit"
                size="lg">
                <x-filament::icon
                    icon="heroicon-m-arrow-up-tray"
                    class="w-5 h-5 mr-2" />
                Import Data
            </x-filament::button>
        </div>
    </form>
    <x-filament-actions::modals />
</x-filament-panels::page>