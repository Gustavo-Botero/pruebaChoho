<?php

namespace App\UseCases\Modulos\Asesor;

use App\UseCases\Contracts\Modulos\Asesor\ShowAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class ShowAsesorUseCase implements ShowAsesorInterface
{
    /**
     * Implementación de AsesorRepositoryInterface
     *
     * @var AsesorRepositoryInterface
     */
    protected $asesorRepository;

    /**
     * Inyección de dependencias
     *
     * @param AsesorRepositoryInterface $asesorRepository
     */
    public function __construct(
        AsesorRepositoryInterface $asesorRepository
    ) {
        $this->asesorRepository = $asesorRepository;
    }

    /**
     * Función para consultar un asesor por id
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array
    {
        $asesor = $this->asesorRepository->find($id);

        return [
            'data' => [
                'id' => $asesor->id,
                'name' => $asesor->name,
                'apellido' => $asesor->apellido,
                'tipo_documento' => $asesor->tipo_documento,
                'numero_documento' => $asesor->numero_documento,
                'celular' => $asesor->celular,
                'correo' => $asesor->correo,
                'direccion' => $asesor->direccion
            ]
        ];
    }
}
