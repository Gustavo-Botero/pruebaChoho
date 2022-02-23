<?php

namespace App\UseCases\Modulos\Asesor;

use App\Models\DetallePedidoModel;
use App\Models\FacturaModel;
use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;

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
        $facturaCliente = '';
        $asesor = $this->asesorRepository->find($id);
        $clientes = $this->clienteRepository->showClientsByAsesor($id);
        $numClientes = count($clientes);
        foreach ($clientes as $cliente) {
            var_dump('cliente id ' . $cliente['id']);
            
            $facturas = FacturaModel::find($cliente['id'])->toArray();
            var_dump($facturas);
            var_dump(count($facturas));
            // $facturaCliente = $facturaCliente + count($facturas);
            // $facturaCliente[] = $factura['id'];
            // var_dump('Facturas id ' . $facturas['id']);
            // foreach ($facturas as $factura) {
            //     dd($factura);
            //     var_dump($factura);
            //     var_dump('factura id' . $factura['id']);
            //     $pedido = DetallePedidoModel::find($factura['id']);
            //     var_dump('pedido' . $pedido);
            // }
        }
        // dd($facturaCliente);
        $totalPedidos = [];//count($facturas);

        // var_dump($clientes);
        // dd($clientes);
        $response['data'] = [
            'cod_asesor' => $asesor->id,
            'name' => $asesor->nombre .' '. $asesor->apellido,
            'clientes_asignados' => $numClientes,
            'total_pedidos' => $totalPedidos
        ];

        // dd($response);


        return $response;
    }

}