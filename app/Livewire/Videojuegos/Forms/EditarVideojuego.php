<?php

namespace App\Livewire\Videojuegos\Forms;

use App\Models\Videojuego;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditarVideojuego extends Form
{
    public ?Videojuego $videojuego=null;
    public string $titulo = '';
    public string $descripcion = '';
    public string $fecha_lanzamiento = '';
    public $imagen;
    public float $precio = 0;
    public array $consolas = [];
    public array $generos = [];

    public function setVideojuego(Videojuego $videojuego)
    {
        $this->videojuego = $videojuego;
        $this->titulo = $videojuego->titulo;
        $this->descripcion = $videojuego->descripcion;
        $this->fecha_lanzamiento = $videojuego->fecha_lanzamiento;
        $this->precio = $videojuego->precio;
        $this->consolas = $videojuego->obtenerIdsConsolas();
        $this->generos = $videojuego->obtenerIdsGeneros();
    }

    public function rules(){
        return [
            'titulo'=>['required', 'string', 'max:30'],
            'descripcion'=>['required', 'string', 'min:10'],
            'fecha_lanzamiento'=>['required', 'date'],
            'precio'=>['required', 'decimal:0,2', 'min:0', 'max:9999.99'],
            'imagen'=>['nullable', 'image', 'max:2048'],
            'consolas'=>['required', 'array', 'min:1', 'exists:consolas,id'],
            'generos'=>['required', 'array', 'min:1', 'exists:generos,id'],
        ];
    }

    public function editarVideojuego(){
        $ruta=$this->videojuego->imagen;
        if($this->imagen){
                Storage::delete($ruta);
                $ruta = $this->imagen->store('public/videojuegos');
            }

        $this->videojuego->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'fecha_lanzamiento' => $this->fecha_lanzamiento,
            'precio' => $this->precio,
            'imagen' => $ruta,
            'stock'=> $this->videojuego->stock,
        ]);

        $this->videojuego->generos()->sync($this->generos);
        $this->videojuego->consolas()->sync($this->consolas);
    }

    public function limpiarCampos(){
        $this->reset(['titulo', 'descripcion', 'fecha_lanzamiento', 'precio', 'imagen', 'consolas', 'generos']);
    }
}
