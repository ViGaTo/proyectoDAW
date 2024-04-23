<?php

namespace App\Livewire\Videojuegos\PlayStation;

use App\Livewire\Videojuegos\Forms\EditarVideojuego;
use App\Models\Consola;
use App\Models\Genero;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowVideojuegosPlayStation extends Component
{
    use WithPagination;
    use WithFileUploads;

    public EditarVideojuego $form;
    public bool $mostrarEditar=false;

    public Videojuego $videojuego;

    public string $cadena = "";
    public string $campo = "id";
    public string $orden = "desc";

    #[On('videojuego-creado')]
    public function render()
    {
        $videojuegos = Videojuego::select('videojuegos.*', 'consolas.nombre as nombre_consola')
            ->join('consolas', 'videojuegos.consola_id', '=', 'consolas.id')
            ->where('consolas.nombre', 'like', 'PlayStation%')
            ->where('titulo', 'like', "%$this->cadena%")
            ->orderBy($this->campo, $this->orden)
            ->paginate(20);

        $generos = Genero::select('id', 'nombre')->orderBy('nombre')->get();
        $consolas = Consola::select('id', 'nombre')->orderBy('consola')->get();

        return view('livewire.videojuegos.playstation.show-videojuegos', compact('videojuegos', 'generos', 'consolas'));
    }

    public function updatingCadena()
    {
        $this->resetPage();
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == "asc") ? "desc" : "asc";
        $this->campo = $campo;
    }

    public function confirmarBorrar(Videojuego $videojuego)
    {
        $this->dispatch('confirmarBorrarVideojuegoPlayStation', $videojuego->id);
    }

    #[On('borrarOkVideojuego')]
    public function borrar(Videojuego $videojuego)
    {
        Storage::delete($videojuego->imagen);

        $videojuego->delete();
        $this->dispatch('mensaje', 'Videojuego borrado con éxito');
    }

    public function editar(Videojuego $videojuego){
        $this->form->setVideojuego($videojuego);
        $this->mostrarEditar=true;
    }

    public function update(){
        $this->form->editarVideojuego();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Videojuego actualizado');
    }

    public function cancelarUpdate(){
        $this->mostrarEditar=false;
        $this->form->limpiarCampos();
    }
}
