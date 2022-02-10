<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Asesor\CreateAsesorInterface;

class AsesorController extends Controller
{
    /**
     * Implementación de CreateAsesorInterface
     *
     * @var CreateAsesorInterface
     */
    protected $createAsesor;

    /**
     * Inyección de dependencias
     *
     * @param CreateAsesorInterface $createAsesor
     */
    public function __construct(
        CreateAsesorInterface $createAsesor
    ) {
        $this->createAsesor = $createAsesor;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
