<?php

namespace App\Repositories\Contracts\Modulos\Producto;

use Illuminate\Http\Request;
use App\Models\ProductoModel;
use Illuminate\Database\Eloquent\Collection;

interface ProductoRepositoryInterface
{

    /**
     * Obtener todos los registros de la tabla producto
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Función para crear un producto
     *
     * @param Request $request
     * @return ProductoModel
     */
    public function create(Request $request): ProductoModel;

    /**
     * Función para eliminar un registro de la tabla productos
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool;

    /**
     * Función para buscar un registro por id de la tabla producto
     *
     * @param integer $id
     * @return ProductoModel
     */
    public function find(int $id): ProductoModel;
}
