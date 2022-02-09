<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ProductoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrearProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_producto()
    {
        // función para mostrar las excepciones
        $this->withoutExceptionHandling();

        // Probamos el endpoint
        $response = $this->postJson('/producto', [
            'data' => [
                'tipo' => 'Cadena',
                'precio' => 50000
            ]
        ]);

        // Revisamos que todo este bien
        $response->assertOk();

        // Consultamos los registros
        $producto = ProductoModel::all();

        // Comprobamos que tengamos un registro en la tabla
        $this->assertCount(1, $producto);

        // Comparamos que sean los datos que guardamos
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'Producto guardado',
            'limpForm' => 'producto',
            'data' => [
                'id' => $producto[0]->id,
                'tipo' => $producto[0]->tipo,
                'precio' => $producto[0]->precio
            ]
        ]);
    }
}
