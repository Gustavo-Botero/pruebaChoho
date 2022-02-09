<?php

namespace App\UseCases\Modulos\Producto;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Producto\CreateProductoInterface;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class CreateProductoUseCase implements CreateProductoInterface
{
    /**
     * Implementación de ProductoRepositoryInterface
     *
     * @var ProductoRepositoryInterface
     */
    protected $productoRepository;

    /**
     * Inyección de dependencias
     *
     * @param ProductoRepositoryInterface $productoRepository
     */
    public function __construct(ProductoRepositoryInterface $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    /**
     * Función para crear un producto
     *
     * @param Request $request
     * @return array
     */
    public function handle(Request $request): array
    {
        $producto = $this->productoRepository->create($request);

        return [
            'alert' => true,
            'icon' => 'success',
            'title' => 'Producto guardado',
            'limpForm' => 'producto',
            'data' => [
                'id' => $producto->id,
                'tipo' => $producto->tipo,
                'precio' => $producto->precio
            ] 
        ];
    }
}