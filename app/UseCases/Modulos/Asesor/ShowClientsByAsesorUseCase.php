<?php

namespace App\UseCases\Modulos\Asesor;

use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;
use App\Repositories\Contracts\Modulos\Factura\FacturaRepositoryInterface;
use App\Repositories\Contracts\Modulos\DetallePedido\DetallePedidoRepositoryInterface;

use function PHPUnit\Framework\isEmpty;

class ShowClientsByAsesorUseCase implements ShowClientsByAsesorInterface
{
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
     * @param ClienteRepositoryInterface $clienteRepository
     * @param FacturaRepositoryInterface $facturaRepository
     * @param DetallePedidoRepositoryInterface $detallePedidoRepository
     */
    public function __construct(
        ClienteRepositoryInterface $clienteRepository,
        FacturaRepositoryInterface $facturaRepository,
        DetallePedidoRepositoryInterface $detallePedidoRepository
    ) {
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
        $clientesByAsesor = $this->clienteRepository->showClientsByAsesor($id);
        $numClientes = 0;
        $totalPedidos = 0;
        $clientesArray = [];
        foreach ($clientesByAsesor as $rowCliente) {
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

        $response['data'] = [
            'cod_asesor' => $clientesByAsesor[0]['asesor']['id'],
            'name' => $clientesByAsesor[0]['asesor']['nombre'] . ' ' . $clientesByAsesor[0]['asesor']['apellido'],
            'clientes_asignados' => $numClientes,
            'total_pedidos' => $totalPedidos,
            'clientes' => $clientesArray
        ];

        return $response;
    }
}
