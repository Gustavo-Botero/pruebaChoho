<?php

namespace App\Repositories\Contracts\Modulos\Asesor;

use App\Models\AsesorModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

interface AsesorRepositoryInterface
{

    /**
     * Función para obtener todos los registros
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Función para crear un asesor
     *
     * @param Request $request
     * @return AsesorModel
     */
    public function create(Request $request): AsesorModel;

    /**
     * Función para eliminar un asesor
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool;

    /**
     * Función para consultar un asesor por id
     *
     * @param integer $id
     * @return AsesorModel
     */
    public function find(int $id): AsesorModel;

    /**
     * Función para actualizar un asesor
     *
     * @param integer $id
     * @param Request $request
     * @return AsesorModel
     */
    public function update(int $id, Request $request): AsesorModel;
}