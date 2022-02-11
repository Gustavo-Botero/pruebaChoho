<?php

namespace App\UseCases\Modulos\Asesor;

use App\UseCases\Contracts\Modulos\Asesor\DeleteAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class DeleteAsesorUseCase implements DeleteAsesorInterface
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
     * Función para eliminar un asesor
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array
    {
        $this->asesorRepository->delete($id);

        return [
            'alert' => true,
            'icon' => 'info',
            'title' => 'El asesor fue eliminado correctamente.',
            'limpForm' => 'asesor'
        ];
    }
}
