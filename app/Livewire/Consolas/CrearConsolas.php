<?php

namespace App\Livewire\Consolas;

use App\Models\Consola;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearConsolas extends Component
{
    public bool $mostrarCrear = false;

    use WithFileUploads;

    #[Validate(['required', 'string', 'max:30'])]
    public string $nombre;

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion;
    public function render()
    {
        return view('livewire.consolas.crear-consolas');
    }

    public function store(){
        $this->validate();
        Consola::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        
        $this->dispatch('consola-creada')->to('consolas.show-consolas');
        $this->dispatch('mensaje', 'Consola creada con éxito');
        $this->cancelarCrear();
    }

    public function cancelarCrear(){
        $this->reset(['nombre', 'descripcion', 'mostrarCrear']);
    }
}
