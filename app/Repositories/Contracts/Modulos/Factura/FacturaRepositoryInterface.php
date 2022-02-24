<?php

namespace App\Repositories\Contracts\Modulos\Factura;

interface FacturaRepositoryInterface 
{
    /**
     * Función para consultar las facturas del cliente
     *
     * @param integer $idCliente
     * @return array
     */
    public function getFacturaByCliente(int $idCliente): array ;
    
}