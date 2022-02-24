<?php

namespace App\Repositories\Contracts\Modulos\Cliente;

use Illuminate\Database\Eloquent\Collection;

interface ClienteRepositoryInterface
{
    /**
     * Función para obtener clientes dependiento del asesor
     *
     * @param integer $id
     * @return Collection
     */
    public function showClientsByAsesor(int $id): array;
}