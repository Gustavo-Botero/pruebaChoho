<?php

namespace App\UseCases\Contracts\Modulos\Producto;

interface DeleteProductoInterface
{
    /**
     * Función para eliminar un registro de la tabla producto
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array;
}
