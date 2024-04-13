<?php

namespace App\Livewire\Consolas\Forms;

use App\Models\Consola;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarConsolas extends Form
{
    public ?Consola $consola=null;
    public string $nombre = '';
    public string $descripcion = '';

    public function setConsola(Consola $consola)
    {
        $this->consola = $consola;
        $this->nombre = $consola->nombre;
        $this->descripcion = $consola->descripcion;
    }

    public function rules(){
        return [
            'nombre'=>['required', 'string', 'max:30'],
            'descripcion'=>['required', 'string', 'min:10'],
        ];
    }

    public function editarConsola(){
        $this->consola->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
    }

    public function limpiarCampos(){
        $this->reset(['nombre', 'descripcion']);
    }
}
