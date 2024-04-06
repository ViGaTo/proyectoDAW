<?php

namespace Database\Seeders;

use App\Models\Consola;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsolaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consolas = [
            'PlayStation 5' => 'Consola de videojuegos de 9º generación de Sony',
            'Xbox Series X' => 'Consola de videojuegos de 9º generación de Microsoft',
            'Nintendo Switch' => 'Consola de videojuegos híbrida de Nintendo',
            'PlayStation 4' => 'Consola de videojugos de 8º generación de Sony',
            'Xbox One' => 'Consola de videojuegos de 8º generación de Microsoft',
            'Nintendo Wii U' => 'Consola de videojuegos de 8º generación de Nintendo',
        ];

        foreach ($consolas as $nombre => $descripcion) {
                Consola::create([
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                ]);
        }
    }
}
