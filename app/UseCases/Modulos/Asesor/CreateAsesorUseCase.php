<?php

namespace App\UseCases\Modulos\Asesor;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class CreateAsesorUseCase implements CreateAsesorInterface
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
     * Función para crear un asesor
     *
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $asesor = $this->asesorRepository->create($request);

        return [
            'alert' => true,
            'icon' => 'success',
            'title' => 'Asesor guardado correctamente',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $asesor->nombre,
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
