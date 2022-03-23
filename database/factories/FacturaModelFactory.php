<?php

namespace Database\Factories;

use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacturaModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => ClienteModel::factory()->create()
        ];
    }
}
