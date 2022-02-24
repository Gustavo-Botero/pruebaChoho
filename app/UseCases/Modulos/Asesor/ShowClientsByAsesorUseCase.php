<?php

namespace App\UseCases\Modulos\Asesor;

use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;
use App\Repositories\Contracts\Modulos\Factura\FacturaRepositoryInterface;
use App\Repositories\Contracts\Modulos\DetallePedido\DetallePedidoRepositoryInterface;

use function PHPUnit\Framework\isEmpty;

class ShowClientsByAsesorUseCase implements ShowClientsByAsesorInterface
{

    /**
     * Implementación de AsesorRepositoryInterface
     *
     * @var AsesorRepositoryInterface
     */
    protected $asesorRepository;

    /**
     * Implementación de ClienteRepositoryInterface
     *
     * @var ClienteRepositoryInterface
     */
    protected $clienteRepository;

    /**
     * Implementación de FacturaRepositoryInterface
     *
     * @var FacturaRepositoryInterface
     */
    protected $facturaRepository;

    /**
     * Implementación de DetallePedidoRepositoryInterface
     *
     * @var DetallePedidoRepositoryInterface
     */
    protected $detallePedidoRepository;

    /**
     * Inyección de dependencias
     *
     * @param AsesorRepositoryInterface $asesorRepository
     * @param ClienteRepositoryInterface $clienteRepository
     * @param FacturaRepositoryInterface $facturaRepository
     * @param DetallePedidoRepositoryInterface $detallePedidoRepository
     */
    public function __construct(
        AsesorRepositoryInterface $asesorRepository,
        ClienteRepositoryInterface $clienteRepository,
        FacturaRepositoryInterface $facturaRepository,
        DetallePedidoRepositoryInterface $detallePedidoRepository
    ) {
        $this->asesorRepository = $asesorRepository;
        $this->clienteRepository = $clienteRepository;
        $this->facturaRepository = $facturaRepository;
        $this->detallePedidoRepository = $detallePedidoRepository;
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

        foreach ($clientesByAsesor as $cliente) {
            $detallePedidosArray = [];

            $facturas = $this->facturaRepository->getFacturaByCliente($cliente['id']);
            $facturaCliente = $facturaCliente + count($facturas);

            foreach ($facturas as $factura) {
                $detallePedido = $this->detallePedidoRepository->getPedidoByFactura($factura['id']);

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
            'clientes_asignados' => count($clientesByAsesor),
            'total_pedidos' => $facturaCliente,
            'clientes' => $clientesArray
        ];

        return $response;
    }
}
