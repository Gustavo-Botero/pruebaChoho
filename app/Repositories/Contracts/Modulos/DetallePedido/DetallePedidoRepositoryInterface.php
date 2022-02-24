<?php

namespace App\Repositories\Contracts\Modulos\DetallePedido;

interface DetallePedidoRepositoryInterface
{
    /**
     * Consultar el detalle de pedido con los productos de cada factura
     *
     * @param integer $idFactura
     * @return array
     */
    public function getPedidoByFactura(int $idFactura): array;
}