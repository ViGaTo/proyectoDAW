<?php

namespace App\Livewire\Videojuegos\Xbox;

use App\Models\Consola;
use App\Models\Genero;
use App\Models\Videojuego;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearVideojuego extends Component
{
    public bool $mostrarCrear = false;

    use WithFileUploads;

    #[Validate(['required', 'string', 'max:30'])]
    public string $titulo;

    #[Validate(['required', 'string', 'min:10'])]
    public string $descripcion;

    #[Validate(['required', 'date'])]
    public string $fecha_lanzamiento;

    #[Validate(['required', 'decimal:0,2', 'min:0', 'max:9999.99'])]
    public float $precio;

    #[Validate(['required', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'array', 'min:1', 'exists:generos,id'])]
    public array $generos = [];

    #[Validate(['required', 'integer', 'min:1', 'exists:consolas,id'])]
    public int $consola = 2;

    public function render()
    {
        $crearGeneros = Genero::select('id', 'nombre')->orderBy('nombre')->get();
        $crearConsolas = Consola::select('id', 'nombre')->orderBy('nombre')->get();

        return view('livewire.videojuegos.xbox.crear-videojuego', compact('crearGeneros', 'crearConsolas'));
    }

    public function store(){
        $this->validate();
        $videojuego = Videojuego::create([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'fecha_lanzamiento' => $this->fecha_lanzamiento,
            'stock' => 0,
            'precio' => $this->precio,
            'imagen' => $this->imagen->store('videojuegos'),
            'consola_id' => $this->consola,
        ]);

        $videojuego->generos()->attach($this->generos);
        
        $this->dispatch('videojuego-creado')->to('videojuegos.xbox.show-videojuegos-xbox');
        $this->dispatch('mensaje', 'Videojuego creado con éxito');
        $this->cancelarCrear();
    }

    public function cancelarCrear(){
        $this->reset(['titulo', 'descripcion', 'fecha_lanzamiento', 'precio', 'imagen', 'generos', 'consola', 'mostrarCrear']);
    }
}
