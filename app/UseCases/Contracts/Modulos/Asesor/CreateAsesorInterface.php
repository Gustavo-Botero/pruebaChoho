<?php

namespace App\UseCases\Contracts\Modulos\Asesor;

use Illuminate\Http\Request;

interface CreateAsesorInterface
{
    /**
     * Función para crear un asesor
     *
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array;
}