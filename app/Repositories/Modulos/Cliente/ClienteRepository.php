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
        return $clientes = $this->cliente->select('cliente.*')->groupBy('cliente.id')->where('asesor_id', $id)->get()->toArray();
        // return $clientes = $this->cliente
        //     ->join('asesor as a', 'a.id', '=', 'cliente.asesor_id')
        //     ->join('factura as f', 'f.cliente_id', '=', 'cliente.id')
        //     ->join('detalle_pedido as dp', 'dp.factura_id', '=', 'f.id')
        //     ->join('producto as p', 'p.id', '=', 'dp.producto_id')
        //     ->select(
        //         'a.id as codigoAsesor',
        //         'a.nombre as nombreAsesor',
        //         'cliente.id as idCliente',
        //         'cliente.nombre as nombreCliente',
        //         'f.id as idFactura',
        //         'p.tipo as tipoProducto',
        //         'dp.id as idDetallePedido',
        //     )->groupBy('cliente.id', 'f.id')//->selectRaw('count(cliente.id) as numLientes')
        //     ->where('asesor_id', $id)
        //     ->get()->toArray();
    }
}
