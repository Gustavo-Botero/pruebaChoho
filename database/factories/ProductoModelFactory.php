<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1,4),
            'tipo' => $this->faker->name(),
            'precio' => $this->faker->numberBetween(50000, 1000000)
        ];
    }
}
