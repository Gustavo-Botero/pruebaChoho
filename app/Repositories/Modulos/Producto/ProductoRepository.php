<?php

namespace App\Repositories\Modulos\Producto;

use Illuminate\Http\Request;
use App\Models\ProductoModel;
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
}