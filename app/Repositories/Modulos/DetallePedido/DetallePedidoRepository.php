<?php

namespace App\Repositories\Modulos\DetallePedido;

use App\Models\DetallePedidoModel;
use App\Repositories\Contracts\Modulos\DetallePedido\DetallePedidoRepositoryInterface;

class DetallePedidoRepository implements DetallePedidoRepositoryInterface
{
    protected $detallePedido;

    public function __construct(DetallePedidoModel $detallePedido)
    {
        $this->detallePedido = $detallePedido;
    }

    /**
     * Consultar el detalle de pedido con los productos de cada factura
     *
     * @param integer $idFactura
     * @return array
     */
    public function getPedidoByFactura(int $idFactura): array
    {
        return $this->detallePedido->join('producto as p', 'p.id', '=', 'detalle_pedido.producto_id')
            ->select(
                'detalle_pedido.*',
                'p.tipo as tipo',
                'p.precio as precio'
            )
            ->where('detalle_pedido.factura_id', $idFactura)->get()->toArray();
    }
}
