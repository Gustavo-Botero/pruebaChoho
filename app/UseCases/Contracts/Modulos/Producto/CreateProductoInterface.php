<?php

namespace App\UseCases\Contracts\Modulos\Producto;

use Illuminate\Http\Request;

interface CreateProductoInterface 
{
    /**
     * Función para crear un producto
     *
     * @param Request $req
     * @return array
     */
    public function handle(Request $req): array;
}

