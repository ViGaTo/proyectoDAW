<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generos = [
            'Acción' => 'Videojuegos de acción',
            'Aventura' => 'Videojuegos de aventura',
            'Deportes' => 'Videojuegos de deportes',
            'Estrategia' => 'Videojuegos de estrategia',
            'Rol' => 'Videojuegos de rol',
            'Simulación' => 'Videojuegos de simulación',
            'Carreras' => 'Videojuegos de carreras',
            'Plataformas' => 'Videojuegos de plataformas',
            'Lucha' => 'Videojuegos de lucha',
            'Shooter' => 'Videojuegos de disparos',
            'Survival Horror' => 'Videojuegos de terror',
            'Battle Royale' => 'Videojuegos de batalla campal',
            'MMORPG' => 'Videojuegos de rol multijugador masivo en línea',
            'Metroidvania' => 'Videojuegos de aventura y plataformas',
            'Sandbox' => 'Videojuegos de mundo abierto',
            'Indie' => 'Videojuegos independientes',
            'Roguelike' => 'Videojuegos de mazmorras aleatorias',
            'Hack and Slash' => 'Videojuegos de acción y aventura',
            'Beat em up' => 'Videojuegos de peleas',
            'Stealth' => 'Videojuegos de sigilo',
            'Battle Royale' => 'Videojuegos de batalla campal',
            'Survival' => 'Videojuegos de supervivencia',
            'Plataformas 2D' => 'Videojuegos de plataformas en 2D',
            'Plataformas 3D' => 'Videojuegos de plataformas en 3D',
            'Puzzle' => 'Videojuegos de rompecabezas',
            'Musical' => 'Videojuegos de música',
            'Educación' => 'Videojuegos educativos',
            'Casual' => 'Videojuegos casuales',
            'Arcade' => 'Videojuegos de arcade',
            'Realidad Virtual' => 'Videojuegos de realidad virtual',
            'Realidad Aumentada' => 'Videojuegos de realidad aumentada',

        ];

        foreach ($generos as $nombre => $descripcion) {
                Genero::create([
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                ]);
        }
    }
}
