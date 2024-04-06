<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genero extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];

    //Relación N:M con Videojuego
    public function videojuegos(): BelongsToMany{
        return $this->belongsToMany(Videojuego::class);
    }

    //Accessors y mutators
    public function nombre(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }

    public function descripcion(): Attribute{
        return Attribute::make(
            set: fn($v)=>ucfirst($v),
        );
    }
}
