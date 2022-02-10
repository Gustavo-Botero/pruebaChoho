<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Producto\ShowProductoInterface;
use App\UseCases\Contracts\Modulos\Producto\CreateProductoInterface;
use App\UseCases\Contracts\Modulos\Producto\DeleteProductoInterface;
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
     * Implementación de ShowProductoInterface
     *
     * @var ShowProductoInterface
     */
    protected $showProducto;

    /**
     * Implementación de DeleteProductoInterface
     *
     * @var DeleteProductoInterface
     */
    protected $deleteProducto;

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
     * @param ShowProductoInterface $showProducto
     * @param DeleteProductoInterface $deleteProducto
     * @param ProductoRepositoryInterface $productoRepository
     */
    public function __construct(
        CreateProductoInterface $createProducto,
        ShowProductoInterface $showProducto,
        DeleteProductoInterface $deleteProducto,
        ProductoRepositoryInterface $productoRepository
    ) {
        $this->createProducto = $createProducto;
        $this->showProducto = $showProducto;
        $this->deleteProducto = $deleteProducto;
        $this->productoRepository = $productoRepository;
    }

    /**
     * Función para eliminar un registro de la tabla producto
     *
     * @param integer $id
     * @return array
     */
    public function destroy(int $id): array
    {
        return $this->deleteProducto->handle($id);
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
     * Función para consultar un registro por id de la tabal producto
     *
     * @param integer $id
     * @return array
     */
    public function show(int $id): array
    {
        return $this->showProducto->handle($id);
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
