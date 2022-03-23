<?php

namespace App\Repositories\Modulos\Cliente;

use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;

class ClienteRepository implements ClienteRepositoryInterface
{
    /**
     * Implementación de ClienteModel 
     *
     * @var ClienteModel
     */
    protected $cliente;

    /**
     * Inyección de dependencias
     *
     * @param ClienteModel $cliente
     */
    public function __construct(ClienteModel $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Función para obtener clientes dependiento del asesor
     *
     * @param integer $id
     * @return Collection
     */
    public function showClientsByAsesor(int $id): array
    {
        return $this->cliente->with('asesor')
            ->with('facturas')
            ->with('facturas.detallePedidos')
            ->with('facturas.detallePedidos.producto')
            ->where('asesor_id', '=', $id)
            ->get()->toArray();
    }
}
