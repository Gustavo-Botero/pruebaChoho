<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id' => $this->faker->unique()->randomDigitNotNull(),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'tipo_documento' => $this->faker->randomElement(['CC', 'CE', 'PT']),
            'numero_documento' => $this->faker->unique()->numberBetween(99999999, 9999999999),
            'celular' => $this->faker->numberBetween(99999999, 9999999999),
            'correo' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->address(),
            'asesor_id' => $this->faker->numberBetween(1,5)
        ];
    }
}
