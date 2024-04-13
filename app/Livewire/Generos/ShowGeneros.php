<?php

namespace App\Livewire\Generos;

use App\Livewire\Generos\Forms\EditarGeneros;
use App\Models\Genero;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowGeneros extends Component
{
    use WithPagination;
    use WithFileUploads;

    public EditarGeneros $form;
    public bool $mostrarEditar=false;

    public Genero $genero;

    public string $cadena = "";
    public string $campo = "id";
    public string $orden = "desc";

    #[On('genero-creado')]
    public function render()
    {
        $generos = Genero::where('nombre', 'like', "%$this->cadena%")
            ->orderBy($this->campo, $this->orden)
            ->paginate(20);

        return view('livewire.generos.show-generos', compact('generos'));
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

    public function confirmarBorrar(Genero $genero)
    {
        $this->dispatch('confirmarBorrarGenero', $genero->id);
    }

    #[On('borrarOkGenero')]
    public function borrar(Genero $genero)
    {
        $genero->delete();
        $this->dispatch('mensaje', 'Género borrado con éxito');
    }

    public function editar(Genero $genero){
        $this->form->setGenero($genero);
        $this->mostrarEditar=true;
    }

    public function update(){
        $this->form->editarGenero();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Género actualizado con éxito');
    }

    public function cancelarUpdate(){
        $this->mostrarEditar=false;
        $this->form->limpiarCampos();
    }
}
