<?php

namespace App\Repositories\Contracts\Modulos\Asesor;

use App\Models\AsesorModel;
use Illuminate\Http\Request;

interface AsesorRepositoryInterface
{
    /**
     * Función para crear un asesor
     *
     * @param Request $request
     * @return AsesorModel
     */
    public function create(Request $request): AsesorModel;
}