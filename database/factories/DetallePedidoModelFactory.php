<?php

namespace Database\Factories;

use App\Models\FacturaModel;
use App\Models\ProductoModel;
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
            'factura_id' => FacturaModel::factory()->create(),
            'producto_id' => ProductoModel::factory()->create(),
            'cantidad' => rand(1, 10)
        ];
    }
}
