<?php

namespace App\UseCases\Modulos\Asesor;

use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;
use App\Repositories\Contracts\Modulos\Cliente\ClienteRepositoryInterface;
use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;

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
        $asesor = $this->asesorRepository->find($id);
        $clientes = $this->clienteRepository->showClientsByAsesor($id);
        var_dump($clientes);
        dd($clientes);
        $response[] = [
            'codigo_asesor' => $asesor->id,
            'nombre' => $asesor->nombre .' '. $asesor->apellido,
            'clientes_asignados' => count($clientes)
        ];


        dd($response);


        return [];
    }
}
