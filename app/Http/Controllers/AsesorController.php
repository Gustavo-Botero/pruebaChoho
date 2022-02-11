<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Asesor\ShowAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface;
use App\Repositories\Contracts\Modulos\Asesor\AsesorRepositoryInterface;

class AsesorController extends Controller
{
    /**
     * Implementación de CreateAsesorInterface
     *
     * @var CreateAsesorInterface
     */
    protected $createAsesor;

    /**
     * Implementación de ShowAsesorInterface
     *
     * @var ShowAsesorInterface
     */
    protected $showAsesor;

    /**
     * Implementación de AsesorRepositoryInterface
     *
     * @var AsesorRepositoryInterface
     */
    protected $asesorRepository;

    /**
     * Inyección de dependencias
     *
     * @param CreateAsesorInterface $createAsesor
     * @param ShowAsesorInterface $showAsesor
     * @param AsesorRepositoryInterface $asesorRepository
     */
    public function __construct(
        CreateAsesorInterface $createAsesor,
        ShowAsesorInterface $showAsesor,
        AsesorRepositoryInterface $asesorRepository
    ) {
        $this->createAsesor = $createAsesor;
        $this->showAsesor = $showAsesor;
        $this->asesorRepository = $asesorRepository;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Función para enviar la información necesaria a la vista principal
     *
     * @return View
     */
    public function index(): View
    {
        $asesor = $this->asesorRepository->all();
        return view('asesor.index', compact('asesor'));
    }

    /**
     * Función para consultar un asesor por id
     *
     * @param integer $id
     * @return array
     */
    public function show(int $id): array
    {
        return $this->showAsesor->handle($id);
    }

    /**
     * Funcrión para crear un asesor
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        return $this->createAsesor->handle($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
