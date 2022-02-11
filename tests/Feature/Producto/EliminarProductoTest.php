<?php

namespace Tests\Feature\Producto;

use Tests\TestCase;
use App\Models\ProductoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EliminarProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_eliminar_producto()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        // Datos de prueba
        $producto = ProductoModel::factory()->create();
        // probando el endpoint
        $response = $this->deleteJson('/producto/' . $producto->id);
        // Nos aseguramos de que todo marcha bien
        $response->assertOk();
        // Revisamos que se haya eliminado el registro de la tabla
        $this->assertCount(0, ProductoModel::all());
        // Comparamos la respuesta
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'info',
            'title' => 'Producto eliminado correctamente.',
            'limpForm' => 'producto'
        ]);
    }
}
