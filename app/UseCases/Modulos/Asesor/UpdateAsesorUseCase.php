<?php

namespace App\UseCases\Modulos\Asesor;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Asesor\UpdateAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class UpdateAsesorUseCase implements UpdateAsesorInterface
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
     * Función para actualizar un asesor
     *
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function handle(int $id, Request $request): array
    {
        $asesor = $this->asesorRepository->update($id, $request);

        return [
            'alert' => true,
            'icon' => 'success',
            'title' => 'El asesor fue actualizado',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $asesor->nombre,
                'apellido' => $asesor->apellido,
                'tipo_documento' => $asesor->tipo_documento,
                'numero_documento' => $asesor->numero_documento,
                'celular' => $asesor->cedular,
                'correo' => $asesor->correo,
                'direccion' => $asesor->direccion
            ]
        ];
    }
}
