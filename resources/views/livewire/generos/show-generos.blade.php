<x-principal>
    <div class="flex w-full mb-1 items-center">
        <div class="w-3/4 flex-1">
            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-3/4"
                type="search" placeholder="Buscar..." wire:model.live="cadena">
            <i class="mr-2 fas fa-search"></i>
        </div>
        <div class="">
            @livewire('generos.crear-generos')
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-striped w-full">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($generos as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>
                            <button wire:click="editar({{ $item->id }})">
                                <i class="fas fa-edit text-green-500 hover:text-4xl"></i>
                            </button>
                            <button wire:click="confirmarBorrar({{ $item->id }})">
                                <i class="fas fa-trash text-red-500 hover:text-4xl"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-2">
        {{ $generos->links() }}
    </div>

    @isset($form->genero)
        <x-dialog-modal wire:model="mostrarEditar">
            <x-slot name="title">
                Editar Género
            </x-slot>
            <x-slot name="content">
                <x-label for="nombre">
                    Nombre
                </x-label>
                <x-input id="nombre" placeholder="Nombre..." class="w-full mt-1" wire:model="form.nombre" />
                <x-input-error for="form.nombre" />

                <x-label for="descripcion" class="mt-4">
                    Descripción
                </x-label>
                <textarea name="descripcion" id="descripcion" class="w-full" placeholder="Descripción..." wire:model="form.descripcion"></textarea>
                <x-input-error for="form.descripcion" />
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button wire:click="update" wire:loading.attr="disabled"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-edit"></i> EDITAR
                    </button>

                    <button wire:click="cancelarUpdate"
                        class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-xmark"></i> CANCELAR
                    </button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endisset
</x-principal>
