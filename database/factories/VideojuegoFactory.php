<?php

namespace Database\Factories;

use App\Models\Consola;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Videojuego>
 */
class VideojuegoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Mmo\Faker\PicsumProvider(fake()));
        return [
            'titulo'=>fake()->unique()->sentence(),
            'descripcion'=>fake()->text(),
            'imagen'=>'videojuegos/'.fake()->picsum('public/storage/videojuegos/', 640, 480, false),
            'stock'=>random_int(1, 100),
            'precio'=>fake()->randomFloat(2, 1, 79.99),
            'fecha_lanzamiento'=>fake()->date(),
            'consola_id'=>Consola::all()->random()->id,
        ];
    }
}
