<div>
    <x-button wire:click="$set('mostrarCrear', true)"><i class="fas fa-add me-1"></i>NUEVO</x-button>

    <x-dialog-modal wire:model="mostrarCrear">
        <x-slot name="title">
            Crear Género
        </x-slot>
        <x-slot name="content">
            <x-label for="nombre">
                Nombre
            </x-label>
            <x-input id="nombre" placeholder="Nombre..." class="w-full mt-1" wire:model="nombre" />
            <x-input-error for="nombre" />

            <x-label for="descripcion" class="mt-4">
                Descripción
            </x-label>
            <textarea name="descripcion" id="descripcion" class="w-full" placeholder="Descripción..." wire:model="descripcion"></textarea>
            <x-input-error for="descripcion" />
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button wire:click="store" wire:loading.attr="disabled"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-save"></i> GUARDAR
                </button>

                <button wire:click="cancelarCrear"
                    class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-xmark"></i> CANCELAR
                </button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>

