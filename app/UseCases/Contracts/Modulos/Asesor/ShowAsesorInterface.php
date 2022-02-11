<?php

namespace App\UseCases\Contracts\Modulos\Asesor;

interface ShowAsesorInterface
{
    /**
     * Función para consultar un asesor por id
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array;
}