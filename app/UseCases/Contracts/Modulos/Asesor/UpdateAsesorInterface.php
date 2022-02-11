<?php

namespace App\UseCases\Contracts\Modulos\Asesor;

use Illuminate\Http\Request;

interface UpdateAsesorInterface
{
    /**
     * Función para actualizar un asesor
     *
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function handle(int $id, Request $request): array;
}