<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ProductoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActualizarProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_actualizar_producto()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Datos de prueba
        $productoModelo = new ProductoModel;
        $producto = $productoModelo->factory()->create();

        // probando el endpoint
        $response = $this->putJson('/producto/' . $producto->id, [
            'data' => [
                'tipo' => 'Baterias',
                'precio' => 50000
            ]
        ]);

        // Nos aseguramos de que todo marcha bien
        $response->assertOk();

        // Revisamos de que tenga por lo menos un dato en la tabla
        $this->assertCount(1, $productoModelo->all());

        // refrescamos los datos
        $producto = $producto->fresh();

        // Comparamos que si lo haya actualizado
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'Producto actualizado',
            'limpForm' => 'producto',
            'data' => [
                'id' => $producto->id,
                'tipo' => $producto->tipo,
                'precio' => $producto->precio,
            ]
        ]);
    }
}
