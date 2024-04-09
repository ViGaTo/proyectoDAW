<x-principal>
    <div class="flex w-full mb-1 items-center">
        <div class="w-3/4 flex-1">
            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-3/4"
                type="search" placeholder="Buscar..." wire:model.live="cadena">
            <i class="mr-2 fas fa-search"></i>
        </div>
        <div class="">
            @livewire('videojuegos.crear-videojuego')
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-striped w-full">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Géneros</th>
                    <th scope="col">Plataformas</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Fecha de lanzamiento</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videojuegos as $item)
                    <tr>
                        <td>{{ $item->titulo }}</td>
                        <td>
                            @foreach ($item->generos as $genero)
                                {{ $loop->last ? $genero->nombre : $genero->nombre . ', ' }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->consolas as $consola)
                                {{ $loop->last ? $consola->nombre : $consola->nombre . ', ' }}
                            @endforeach
                        </td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->fecha_lanzamiento }}</td>
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
        {{ $videojuegos->links() }}
    </div>

    @isset($form->videojuego)
        <x-dialog-modal wire:model="mostrarEditar">
            <x-slot name="title">
                Editar Videojuego
            </x-slot>
            <x-slot name="content">
                <x-label for="titulo">
                    Título
                </x-label>
                <x-input id="titulo" placeholder="Título..." class="w-full mt-1" wire:model="form.titulo" />
                <x-input-error for="form.titulo" />

                <x-label for="descripcion" class="mt-4">
                    Descripción
                </x-label>
                <textarea name="descripcion" id="descripcion" class="w-full" placeholder="Descripción..." wire:model="form.descripcion"></textarea>
                <x-input-error for="form.descripcion" />

                <x-label for="precio" class="mt-4">
                    Precio (€)
                </x-label>
                <x-input type="number" id="precio" placeholder="Precio..." step="0.01" class="w-full mt-1"
                    min="0" max="9999.99" wire:model="form.precio" />
                <x-input-error for="form.precio" />

                <x-label for="fechaLanzamiento" class="mt-4">
                    Fecha de lanzamiento
                </x-label>
                <x-input type="date" id="fecha_lanzamiento" class="w-full mt-1" wire:model="form.fecha_lanzamiento" />
                <x-input-error for="form.fecha_lanzamiento" />

                <x-label for="generos" class="mt-4">
                    Géneros
                </x-label>
                <div class="flex flex-wrap">
                    @foreach ($generos as $genero)
                        <div class="flex items-center me-auto mt-1">
                            <input id="{{ $genero->id }}" wire:model="form.generos" type="checkbox"
                                value="{{ $genero->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="{{ $genero->id }}"
                                class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 p-2 rounded-xl">
                                {{ $genero->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="form.generos" />

                <x-label for="consolas" class="mt-4">
                    Plataformas
                </x-label>
                <div class="flex flex-wrap">
                    @foreach ($consolas as $consola)
                        <div class="flex items-center me-auto mt-1">
                            <input id="{{ $consola->id }}" wire:model="form.consolas" type="checkbox"
                                value="{{ $consola->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="{{ $consola->id }}"
                                class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 p-2 rounded-xl">
                                {{ $consola->nombre }}</label>
                        </div>
                    @endforeach
                </div>
                <x-input-error for="form.consolas" />

                <x-label for="imagenU" class="mt-4">
                    Imagen
                </x-label>
                <div class="relative w-full h-72 bg-gray-200 rounded">
                    <input type="file" wire:model="form.imagen" accept="image/*" hidden id="imagenU" />
                    <label for="imagenU"
                        class="absolute bottom-2 end-2 bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded"><i
                            class="fa-solid fa-upload mr-2"></i>Subir</label>
                    @if ($form->imagen)
                        <img src="{{ $form->imagen->temporaryUrl() }}"
                            class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center">
                    @else
                        <img src="{{ Storage::url($form->videojuego->imagen) }}"
                            class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center">
                    @endif
                </div>
                <x-input-error for="form.imagen" />
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
