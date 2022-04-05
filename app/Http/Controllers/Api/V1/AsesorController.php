<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\AsesorRequest;
use App\UseCases\Contracts\Modulos\Asesor\ShowAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\DeleteAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\UpdateAsesorInterface;
use App\UseCases\Contracts\Modulos\Asesor\ShowClientsByAsesorInterface;
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
     * Implementación de ShowClientsByAsesorInterface
     *
     * @var ShowClientsByAsesorInterface
     */
    protected $showClientsByAsesor;

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
     * @param ShowClientsByAsesorInterface $showClientsByAsesor
     * @param AsesorRepositoryInterface $asesorRepository
     */
    public function __construct(
        CreateAsesorInterface $createAsesor,
        ShowAsesorInterface $showAsesor,
        DeleteAsesorInterface $deleteAsesor,
        UpdateAsesorInterface $updateAsesor,
        ShowClientsByAsesorInterface $showClientsByAsesor,
        AsesorRepositoryInterface $asesorRepository
    ) {
        $this->createAsesor = $createAsesor;
        $this->showAsesor = $showAsesor;
        $this->deleteAsesor = $deleteAsesor;
        $this->updateAsesor = $updateAsesor;
        $this->showClientsByAsesor = $showClientsByAsesor;
        $this->asesorRepository = $asesorRepository;
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
     * Funcrión para crear un asesor
     *
     * @param AsesorRequest $request
     * @return array
     */
    public function store(AsesorRequest $request): array
    {
        return $this->createAsesor->handle($request);
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
     * Función para actualizar un asesor
     *
     * @param AsesorRequest $request
     * @param integer $id
     * @return array
     */
    public function update(AsesorRequest $request, int $id): array
    {
        return $this->updateAsesor->handle($id, $request);
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
     * Función para consultar los clientes que tiene cada asesor
     *
     * @param integer $id
     * @return array
     */
    public function showClientesByAsesor(int $id): array
    {
        return $this->showClientsByAsesor->handle($id);
    }
}
