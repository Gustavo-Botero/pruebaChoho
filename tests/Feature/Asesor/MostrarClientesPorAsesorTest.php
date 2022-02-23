<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use App\Models\ClienteModel;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\DetallePedidoModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MostrarClientesPorAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_clientes_por_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        
        // Creamos los registros para prueba
        $asesor = AsesorModel::factory(5)->create();
        $clientes = ClienteModel::factory(9)->create();
        $factura = FacturaModel::factory(9)->create();
        $producto = ProductoModel::factory(10)->create();
        $detallePedido = DetallePedidoModel::factory(15)->create();
        
        $cliente = ClienteModel::where('asesor_id', '=', $asesor[0]->id)->get();
        $totalPedidos = [];//FacturaModel::where('cliente_id', '=', $cliente[0]->id)->get();

        // probamos el endpoint
        $response = $this->getJson('/asesor/clientes/' . $asesor[0]->id);
        
        // Nos aseguramos de que todo esta bien
        $response->assertOk();

        // Revisamos de que la respuesta sea lo esperado
        $response->assertExactJson([
            'data' => [
                'cod_asesor' => $asesor[0]->id,
                'name' => $asesor[0]->nombre  . ' ' . $asesor[0]->apellido,
                'clientes_asignados' => count($cliente),
                'total_pedidos' => $totalPedidos
            ]
        ]);
    }
}
