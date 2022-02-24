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
        $asesor = new AsesorModel();
        $clientes = new ClienteModel();
        $factura = new FacturaModel();
        $producto = new ProductoModel();
        $detallePedido = new DetallePedidoModel();

        $asesor->factory(5)->create();
        $clientes->factory(9)->create();
        $factura->factory(9)->create();
        $producto->factory(10)->create();
        $detallePedido->factory(15)->create();

        // probamos el endpoint
        $response = $this->getJson('/asesor/clientes/' . $asesor->first()->id);

        // Nos aseguramos de que todo esta bien
        $response->assertOk();
        
        $cliente = $clientes->where('asesor_id', '=', $asesor->first()->id)->get()->toArray();
        $facturaCliente = 0;
        $clientesArray = [];
        $detallePedidosArray = [];
        $detalleProductoArray = [];
        
        foreach ($cliente as $rowCliente) {
            $detallePedidosArray = [];
            $facturas = $factura->where('cliente_id', '=', $rowCliente['id'])->get();
            
            $facturaCliente = $facturaCliente + count($facturas);
            foreach ($facturas as $factura) {
                $detallePedido = DetallePedidoModel::join('producto as p', 'p.id', '=', 'detalle_pedido.producto_id')
                    ->select(
                        'detalle_pedido.*',
                        'p.tipo as tipo',
                        'p.precio as precio'
                    )
                    ->where('detalle_pedido.factura_id', $factura['id'])->get()->toArray();

                $detalleProductoArray = [];
                foreach ($detallePedido as $key => $detalle) {

                    array_push(
                        $detalleProductoArray,
                        [
                            'id_producto' => $detalle['producto_id'],
                            'tipo' => $detalle['tipo'],
                            'cantidad' => $detalle['cantidad'],
                            'valor_unitario' => $detalle['precio']
                        ]
                    );
                }

                array_push(
                    $detallePedidosArray,
                    [
                        'id_pedido' => $factura['id'],
                        'total_productos' => count($detallePedido),
                        'fecha' => !isEmpty($detallePedido) ?  $detallePedido[0]['created_at'] : '',
                        'productos' => $detalleProductoArray
                    ]
                );
            }
            
            array_push(
                $clientesArray,
                [
                    'id_cliente' => $rowCliente['id'],
                    'total_pedidos' => count($facturas),
                    'name' => $rowCliente['nombre'],
                    'detalle_pedidos' => $detallePedidosArray
                ]
            );
        }
        
        // Revisamos de que la respuesta sea lo esperado
        $response->assertExactJson([
            'data' => [
                'cod_asesor' => $asesor->first()->id,
                'name' => $asesor->first()->nombre  . ' ' . $asesor->first()->apellido,
                'clientes_asignados' => count($cliente),
                'total_pedidos' => $facturaCliente,
                'clientes' => $clientesArray
            ]
        ]);
    }
}
