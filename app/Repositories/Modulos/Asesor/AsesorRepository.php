<?php

namespace App\Repositories\Modulos\Asesor;

use App\Models\AsesorModel;
use Illuminate\Http\Request;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class AsesorRepository implements AsesorRepositoryInterface
{
    /**
     * Implementación de AsesorModel
     *
     * @var AsesorModel
     */
    protected $asesor;

    /**
     * Inyección de dependencias
     *
     * @param AsesorModel $asesor
     */
    public function __construct(AsesorModel $asesor)
    {
        $this->asesor = $asesor;
    }

    /**
     * Función para crear un asesor
     *
     * @param Request $request
     * @return AsesorModel
     */
    public function create(Request $request): AsesorModel
    {
        $asesor = new $this->asesor;
        $asesor->nombre = $request->data['nombre'];
        $asesor->apellido = $request->data['apellido'];
        $asesor->tipo_documento = $request->data['tipo_documento'];
        $asesor->numero_documento = $request->data['numero_documento'];
        $asesor->celular = $request->data['celular'];
        $asesor->correo = $request->data['correo'];
        $asesor->direccion = $request->data['direccion'];
        $asesor->save();

        return $asesor;
    }
}