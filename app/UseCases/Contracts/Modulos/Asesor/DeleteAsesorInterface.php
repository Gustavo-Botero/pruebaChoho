<?php

namespace App\UseCases\Contracts\Modulos\Asesor;

interface DeleteAsesorInterface
{
    /**
     * Función para eliminar un asesor
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array;
}