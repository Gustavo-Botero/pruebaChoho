<?php

namespace App\Repositories\Modulos\Producto;

use Illuminate\Http\Request;
use App\Models\ProductoModel;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class ProductoRepository implements ProductoRepositoryInterface
{
    /**
     * Implementación de ProductoModel
     *
     * @var ProductoModel
     */
    protected $producto;

    /**
     * Inyección de dependencias
     *
     * @param ProductoModel $producto
     */
    public function __construct(ProductoModel $producto)
    {
        $this->producto = $producto;
    }

    /**
     * Obtener todos los registros de la tabla producto
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->producto->all();
    }

    /**
     * Función para crear un producto
     *
     * @param Request $request
     * @return ProductoModel
     */
    public function create(Request $request): ProductoModel
    {
        $producto = new $this->producto;

        $producto->tipo = $request->data['tipo'];
        $producto->precio = $request->data['precio'];
        $producto->save();

        return $producto;
    }

    /**
     * Función para buscar un registro por id de la tabla producto
     *
     * @param integer $id
     * @return ProductoModel
     */
    public function find(int $id): ProductoModel
    {
        return $this->producto->find($id);
    }
}
