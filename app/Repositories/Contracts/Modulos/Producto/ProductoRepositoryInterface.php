<?php

namespace App\Repositories\Contracts\Modulos\Producto;

use Illuminate\Http\Request;
use App\Models\ProductoModel;

interface ProductoRepositoryInterface
{
    /**
     * Función para crear un producto
     *
     * @param Request $request
     * @return ProductoModel
     */
    public function create(Request $request): ProductoModel;
}