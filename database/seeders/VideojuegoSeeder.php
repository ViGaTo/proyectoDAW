<?php

namespace Database\Seeders;

use App\Models\Consola;
use App\Models\Genero;
use App\Models\Videojuego;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideojuegoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $juegos = Videojuego::factory(50)->create();

        foreach ($juegos as $item) {
            $item->consolas()->attach(self::devolverConsola());
            $item->generos()->attach(self::devolverGenero());
        }
    }

    private static function devolverConsola(): array
    {
        $consolas=[];
        $consolasId = Consola::pluck('id')->toArray();
        $arrayIndices = array_rand($consolasId, random_int(2, count($consolasId)));
        foreach ($arrayIndices as $indice) {
            $consolas[] = $consolasId[$indice];
        }

        return $consolas;
    }

    private static function devolverGenero(): array
    {
        $generos=[];
        $generosId = Genero::pluck('id')->toArray();
        $arrayIndices = array_rand($generosId, random_int(2, count($generosId)));
        foreach ($arrayIndices as $indice) {
            $generos[] = $generosId[$indice];
        }

        return $generos;
    }
}
