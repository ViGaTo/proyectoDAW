<div>
    <x-button wire:click="$set('mostrarCrear', true)"><i class="fas fa-add me-1"></i>NUEVO</x-button>

    <x-dialog-modal wire:model="mostrarCrear">
        <x-slot name="title">
            Crear Videojuego
        </x-slot>
        <x-slot name="content">
            <x-label for="titulo">
                Título
            </x-label>
            <x-input id="titulo" placeholder="Título..." class="w-full mt-1" wire:model="titulo" />
            <x-input-error for="titulo" />

            <x-label for="descripcion" class="mt-4">
                Descripción
            </x-label>
            <textarea name="descripcion" id="descripcion" class="w-full" placeholder="Descripción..." wire:model="descripcion"></textarea>
            <x-input-error for="descripcion" />

            <div class="row">
                <div class="col-4">
                    <x-label for="precio" class="mt-4">
                        Precio (€)
                    </x-label>
                    <x-input type="number" id="precio" placeholder="Precio..." step="0.01" class="w-full mt-1"
                        min="0" max="9999.99" wire:model="precio" />
                    <x-input-error for="precio" />
                </div>

                <div class="col-4">
                    <x-label for="fechaLanzamiento" class="mt-4">
                        Fecha de lanzamiento
                    </x-label>
                    <x-input type="date" id="fecha_lanzamiento" class="w-full mt-1" wire:model="fecha_lanzamiento" />
                    <x-input-error for="fecha_lanzamiento" />
                </div>

                <div class="col-4">
                    <x-label for="consola" class="mt-4">
                        Plataforma
                    </x-label>
                    <select id="consola" class="w-full mt-1" wire:model="consola">
                        <option value="">Selecciona una plataforma</option>
                        @foreach ($crearConsolas as $consola)
                            <option value="{{ $consola->id }}">{{ $consola->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="consola" />
                </div>

            </div>

<x-label for="generos" class="mt-4">
    Géneros
</x-label>
<div class="flex flex-wrap">
    @foreach ($crearGeneros as $genero)
        <div class="flex items-center me-auto mt-1">
            <input id="{{ $genero->id }}" wire:model="generos" type="checkbox" value="{{ $genero->id }}"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
            <label for="{{ $genero->id }}"
                class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 p-2 rounded-xl">
                {{ $genero->nombre }}</label>
        </div>
    @endforeach
</div>
<x-input-error for="generos" />

<x-label for="imagenC" class="mt-4">
    Imagen
</x-label>
<div class="relative w-full h-72 bg-gray-200 rounded">
    <input type="file" wire:model="imagen" accept="image/*" hidden id="imagenC" />
    <label for="imagenC"
        class="absolute bottom-2 end-2 bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded"><i
            class="fa-solid fa-upload mr-2"></i>Subir</label>
    @if ($imagen)
        <img src="{{ $imagen->temporaryUrl() }}" class="p-1 rounded w-full h-full br-no-repeat bg-cover bg-center">
    @endif
</div>
<x-input-error for="imagen" />
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
