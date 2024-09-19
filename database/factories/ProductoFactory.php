<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('PROD###'),
            'nombre' => $this->faker->firstName(),
            'descripcion' => $this->faker->sentence(),
            'categoria' => $this->faker->randomElement(['calzado', 'ropa', 'joyería']),
            'precio' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(10, 200),
        ];
    }
}
