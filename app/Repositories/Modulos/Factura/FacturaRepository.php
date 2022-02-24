<?php

namespace App\Repositories\Modulos\Factura;

use App\Models\FacturaModel;
use App\Repositories\Contracts\Modulos\Factura\FacturaRepositoryInterface;

class FacturaRepository implements FacturaRepositoryInterface
{
    /**
     * Implementación de FacturaModel 
     *
     * @var FacturaModel
     */
    protected $factura;

    /**
     * Inyección de dependencias
     *
     * @param FacturaModel $factura
     */
    public function __construct(FacturaModel $factura)
    {
        $this->factura = $factura;
    }

    /**
     * Función para consultar las facturas del cliente
     *
     * @param integer $idCliente
     * @return array
     */
    public function getFacturaByCliente(int $idCliente): array
    {
        return $this->factura->where('cliente_id', '=', $idCliente)->get()->toArray();
    }
}