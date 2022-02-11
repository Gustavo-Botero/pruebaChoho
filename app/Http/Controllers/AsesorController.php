<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Asesor\ShowAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\DeleteAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\UpdateAsesorInterface;
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
     * Implementación de DeleteAsesorInterface
     *
     * @var DeleteAsesorInterface
     */
    protected $deleteAsesor;

    /**
     * Implementación de UpdateAsesorInterface
     *
     * @var UpdateAsesorInterface
     */
    protected $updateAsesor;

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
     * @param DeleteAsesorInterface $deleteAsesor
     * @param UpdateAsesorInterface $updateAsesor
     * @param AsesorRepositoryInterface $asesorRepository
     */
    public function __construct(
        CreateAsesorInterface $createAsesor,
        ShowAsesorInterface $showAsesor,
        DeleteAsesorInterface $deleteAsesor,
        UpdateAsesorInterface $updateAsesor,
        AsesorRepositoryInterface $asesorRepository
    ) {
        $this->createAsesor = $createAsesor;
        $this->showAsesor = $showAsesor;
        $this->deleteAsesor = $deleteAsesor;
        $this->updateAsesor = $updateAsesor;
        $this->asesorRepository = $asesorRepository;
    }

    /**
     * Función para eliminar un asesors
     *
     * @param integer $id
     * @return array
     */
    public function destroy(int $id): array
    {
        return $this->deleteAsesor->handle($id);
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
     * Función para actualizar un asesor
     *
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function update(Request $request, int $id): array
    {
        return $this->updateAsesor->handle($id, $request);
    }
}
