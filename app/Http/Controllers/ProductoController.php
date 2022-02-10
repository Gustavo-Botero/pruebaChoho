<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ProductoModel;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Producto\CreateProductoInterface;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class ProductoController extends Controller
{
    /**
     * Implementación de CreateProductoInterface
     *
     * @var CreateProductoInterface
     */
    protected $createProducto;

    /**
     * Implemenación de ProductoRepositoryInterface
     *
     * @var ProductoRepositoryInterface
     */
    protected $productoRepository;

    /**
     * Inyección de dependencias
     *
     * @param CreateProductoInterface $createProducto
     * @param ProductoRepositoryInterface $productoRepository
     */
    public function __construct(
        CreateProductoInterface $createProducto,
        ProductoRepositoryInterface $productoRepository
    ) {
        $this->createProducto = $createProducto;
        $this->productoRepository = $productoRepository;
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
     * Función que envía datos a la vista principal
     *
     * @return View
     */
    public function index(): View
    {
        $producto = $this->productoRepository->all();
        
        return view('producto.index', compact('producto'));
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
