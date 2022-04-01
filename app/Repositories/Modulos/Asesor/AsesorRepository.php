<?php

namespace App\Repositories\Modulos\Asesor;

use App\Models\AsesorModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
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
     * Función para obtener todos los registros
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->asesor->all();
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
        $asesor->nombre = $request->nombre;
        $asesor->apellido = $request->apellido;
        $asesor->tipo_documento = $request->tipo_documento;
        $asesor->numero_documento = $request->numero_documento;
        $asesor->celular = $request->celular;
        $asesor->correo = $request->correo;
        $asesor->direccion = $request->direccion;
        $asesor->save();

        return $asesor;
    }

    /**
     * Función para eliminar un asesor
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }

    /**
     * Función para consultar un asesor por id
     *
     * @param integer $id
     * @return AsesorModel
     */
    public function find(int $id): AsesorModel
    {
        return $this->asesor->find($id);
    }

    /**
     * Función para actualizar un asesor
     *
     * @param integer $id
     * @param Request $request
     * @return AsesorModel
     */
    public function update(int $id, Request $request): AsesorModel
    {
        $asesor = $this->find($id);
        $asesor->nombre = $request->nombre;
        $asesor->apellido = $request->apellido;
        $asesor->tipo_documento = $request->tipo_documento;
        $asesor->numero_documento = $request->numero_documento;
        $asesor->celular = $request->celular;
        $asesor->correo = $request->correo;
        $asesor->direccion = $request->direccion;
        $asesor->update();

        return $asesor;
    }
}