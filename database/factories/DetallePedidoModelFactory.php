<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetallePedidoModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'factura_id' => rand(1, 9),
            'producto_id' => rand(1, 9),
            'cantidad' => rand(1, 10)
        ];
    }
}
