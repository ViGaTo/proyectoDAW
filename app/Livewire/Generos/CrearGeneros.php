<?php

namespace App\Livewire\Generos;

use App\Models\Genero;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearGeneros extends Component
{
    public bool $mostrarCrear = false;

    use WithFileUploads;

    #[Validate(['required', 'string', 'max:30'])]
    public string $nombre;

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion;

    public function render()
    {
        return view('livewire.generos.crear-generos');
    }

    public function store(){
        $this->validate();
        Genero::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        
        $this->dispatch('genero-creado')->to('generos.show-generos');
        $this->dispatch('mensaje', 'Género creado con éxito');
        $this->cancelarCrear();
    }

    public function cancelarCrear(){
        $this->reset(['nombre', 'descripcion', 'mostrarCrear']);
    }
}
