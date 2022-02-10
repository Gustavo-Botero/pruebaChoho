<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ProductoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MostrarProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_producto()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        // Creamos los registros de la tabla
        $producto = ProductoModel::factory()->create();
        // probamos el endpoint
        $response = $this->getJson('/producto/' . $producto->id);
        // Nos aseguramos de que todo esta bien
        $response->assertOk();

        // Revisamos que nos devuelva exactamente lo que necesitamos
        $response->assertExactJson([
            'data' => [
                'id' => $producto->id,
                'tipo' => $producto->tipo,
                'precio' => $producto->precio,
            ]
        ]);
    }
}
