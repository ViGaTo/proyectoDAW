<?php

namespace App\Livewire\Generos\Forms;

use App\Models\Genero;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarGeneros extends Form
{
    public ?Genero $genero=null;
    public string $nombre = '';
    public string $descripcion = '';

    public function setGenero(Genero $genero)
    {
        $this->genero = $genero;
        $this->nombre = $genero->nombre;
        $this->descripcion = $genero->descripcion;
    }

    public function rules(){
        return [
            'nombre'=>['required', 'string', 'max:30'],
            'descripcion'=>['required', 'string', 'min:10'],
        ];
    }

    public function editarGenero(){
        $this->genero->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
    }

    public function limpiarCampos(){
        $this->reset(['nombre', 'descripcion']);
    }
}
