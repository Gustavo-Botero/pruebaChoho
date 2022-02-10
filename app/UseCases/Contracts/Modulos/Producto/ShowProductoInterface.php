<?php

namespace App\UseCases\Contracts\Modulos\Producto;


interface ShowProductoInterface
{
    /**
     * Función para buscar un registro por id de la tabla producto
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array;
}