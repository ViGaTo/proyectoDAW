<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Videojuego extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'stock', 'precio', 'fecha_lanzamiento'];

    //Relación N:M con Genero
    public function generos(): BelongsToMany
    {
        return $this->belongsToMany(Genero::class);
    }

    //Relación N:M con Consola
    public function consolas(): BelongsToMany
    {
        return $this->belongsToMany(Consola::class);
    }

    //Accessors y mutators
    public function titulo(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }

    public function descripcion(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }

    public function obtenerIdsGeneros(){
        $generos = [];
        foreach ($this->generos as $genero) {
            $generos[] = $genero->id;
        }
        return $generos;
    }

    public function obtenerIdsConsolas(){
        $consolas = [];
        foreach ($this->consolas as $consola) {
            $consolas[] = $consola->id;
        }
        return $consolas;
    }
}
