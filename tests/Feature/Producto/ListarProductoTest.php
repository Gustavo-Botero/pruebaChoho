<?php

namespace Tests\Feature\Producto;

use Tests\TestCase;
use App\Models\ProductoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListarProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_producto()
    {
        $this->withoutExceptionHandling();

        // Crear datos de prueba
        ProductoModel::factory(4)->create();
        
        // Consumir la ruta
        $response = $this->getJson('/producto');
        
        // Asegurarnos de que todo esta bien en esa ruta
        $response->assertOk();
        
        $producto = ProductoModel::all();

        // Revisar que tengamos los registros creados
        $this->assertCount(4, $producto);
        
        // Crear la vista
        $response->assertViewIs('producto.index');
        
        // Enviar datos a la vista
        $response->assertViewHas('producto', $producto);
        
    }
}
