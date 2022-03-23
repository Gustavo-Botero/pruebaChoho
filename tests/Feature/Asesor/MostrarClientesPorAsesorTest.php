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

use function PHPUnit\Framework\isEmpty;

class MostrarClientesPorAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_clientes_por_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Creamos los registros para prueba
        $asesorModel = AsesorModel::factory()->create();
        $clienteModel = ClienteModel::factory(3)->create([
            'asesor_id' => $asesorModel->id
        ]);
        $productoModel = ProductoModel::factory(3)->create();;
        $facturaModel = FacturaModel::factory(3)->create([
            'cliente_id' => $clienteModel[0]->id
        ]);
        // dd($facturaModel);
        $detallePedidoModel = DetallePedidoModel::factory(3)->create([
            'factura_id' => $facturaModel[0]->id,
            'producto_id' => $productoModel[0]->id
        ]);

        // probamos el endpoint
        $response = $this->getJson('/asesor/clientes/' . $asesorModel->id);

        // Nos aseguramos de que todo esta bien
        $response->assertOk();

        $cliente = ClienteModel::with('asesor')
            ->with('facturas')
            ->with('facturas.detallePedidos')
            ->with('facturas.detallePedidos.producto')
            ->where('asesor_id', '=', $asesorModel->id)
            ->get()->toArray();

        $numClientes = 0;
        $totalPedidos = 0;
        $clientesArray = [];
        foreach ($cliente as $rowCliente) {
            $numClientes++;
            $totalPedidos += count($rowCliente['facturas']);
            $detallePedidosArray = [];
            foreach ($rowCliente['facturas'] as $facturas) {
                $productosArray = [];
                foreach ($facturas['detalle_pedidos'] as $pedidos) {

                    array_push($productosArray, [
                        'id_producto' => $pedidos['producto']['id'],
                        'tipo' => $pedidos['producto']['tipo'],
                        'cantidad' => $pedidos['cantidad'],
                        'valor_unitario' => $pedidos['producto']['precio']
                    ]);
                }

                array_push($detallePedidosArray, [
                    'id_pedido' => $facturas['id'],
                    'total_productos' => count($facturas['detalle_pedidos']),
                    'productos' => $productosArray
                ]);
            }

            array_push($clientesArray, [
                'id_cliente' => $rowCliente['id'],
                'total_pedidos' => count($rowCliente['facturas']),
                'nombre' => $rowCliente['nombre'] . ' ' . $rowCliente['apellido'],
                'detalle_pedidos' => $detallePedidosArray
            ]);
        }

        // Revisamos de que la respuesta sea lo esperado
        $response->assertExactJson([
            'data' => [
                'cod_asesor' => $asesorModel->id,
                'name' => $asesorModel->nombre  . ' ' . $asesorModel->apellido,
                'clientes_asignados' => $numClientes,
                'total_pedidos' => $totalPedidos,
                'clientes' => $clientesArray
            ]
        ]);
    }
}
