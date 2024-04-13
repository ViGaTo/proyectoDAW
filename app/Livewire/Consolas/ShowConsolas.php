<?php

namespace App\Livewire\Consolas;

use App\Livewire\Consolas\Forms\EditarConsolas;
use App\Models\Consola;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowConsolas extends Component
{
    use WithPagination;
    use WithFileUploads;

    public EditarConsolas $form;
    public bool $mostrarEditar=false;

    public Consola $consola;

    public string $cadena = "";
    public string $campo = "id";
    public string $orden = "desc";

    #[On('consola-creada')]
    public function render()
    {
        $consolas = Consola::where('nombre', 'like', "%$this->cadena%")
            ->orderBy($this->campo, $this->orden)
            ->paginate(20);

        return view('livewire.consolas.show-consolas', compact('consolas'));
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

    public function confirmarBorrar(Consola $consola)
    {
        $this->dispatch('confirmarBorrarConsola', $consola->id);
    }

    #[On('borrarOkConsola')]
    public function borrar(Consola $consola)
    {
        $consola->delete();
        $this->dispatch('mensaje', 'Consola borrada con éxito');
    }

    public function editar(Consola $consola){
        $this->form->setConsola($consola);
        $this->mostrarEditar=true;
    }

    public function update(){
        $this->form->editarConsola();
        $this->cancelarUpdate();
        $this->dispatch('mensaje', 'Consola actualizada');
    }

    public function cancelarUpdate(){
        $this->mostrarEditar=false;
        $this->form->limpiarCampos();
    }
}
