<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Producto\CreateProductoInterface;

class ProductoController extends Controller
{
    /**
     * Implementación de CreateProductoInterface
     *
     * @var CreateProductoInterface
     */
    protected $createProducto;

    /**
     * Inyección de dependencias
     *
     * @param CreateProductoInterface $createProducto
     */
    public function __construct(
        CreateProductoInterface $createProducto
    ) {
        $this->createProducto = $createProducto;
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
     * Función para crear un producto
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        return $this->createProducto->handle($request);
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
