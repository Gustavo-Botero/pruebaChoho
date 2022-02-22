<?php

namespace App\UseCases\Contracts\Modulos\Asesor;

interface ShowClientsByAsesorInterface
{
    /**
     * Función para mostrar los clientes que tiene cada asesor
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array;
}