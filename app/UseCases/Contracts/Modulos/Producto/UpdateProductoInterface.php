<?php

namespace App\UseCases\Contracts\Modulos\Producto;

use Illuminate\Http\Request;

interface UpdateProductoInterface
{
    /**
     * Función para actualizar un producto
     *
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function handle(int $id, Request $request): array;
}
