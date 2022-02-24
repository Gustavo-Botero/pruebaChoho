<?php

namespace App\UseCases\Modulos\Asesor;

use App\Models\FacturaModel;
use App\Models\DetallePedidoModel;
use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;

use function PHPUnit\Framework\isEmpty;

class ShowClientsByAsesorUseCase implements ShowClientsByAsesorInterface
{

    protected $asesorRepository;

    protected $clienteRepository;

    public function __construct(
        AsesorRepositoryInterface $asesorRepository,
        ClienteRepositoryInterface $clienteRepository
    ) {
        $this->asesorRepository = $asesorRepository;
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Función para mostrar los clientes que tiene cada asesor
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array
    {
        $facturaCliente = 0;
        $clientesArray = [];
        $detallePedidosArray = [];
        $detalleProductoArray = [];
        $asesor = $this->asesorRepository->find($id);
        $clientesByAsesor = $this->clienteRepository->showClientsByAsesor($id);
        $numClientes = count($clientesByAsesor);

        foreach ($clientesByAsesor as $cliente) {
            $detallePedidosArray = [];
            
            $facturas = FacturaModel::where('cliente_id', '=', $cliente['id'])->get()->toArray();
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
                    'id_cliente' => $cliente['id'],
                    'total_pedidos' => count($facturas),
                    'name' => $cliente['nombre'],
                    'detalle_pedidos' => $detallePedidosArray
                ]
            );
        }
        
        $response['data'] = [
            'cod_asesor' => $asesor->id,
            'name' => $asesor->nombre . ' ' . $asesor->apellido,
            'clientes_asignados' => $numClientes,
            'total_pedidos' => $facturaCliente,
            'clientes' => $clientesArray
        ];

        return $response;
    }
}
