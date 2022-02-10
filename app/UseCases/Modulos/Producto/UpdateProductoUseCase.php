<?php

namespace App\UseCases\Modulos\Producto;

use Illuminate\Http\Request;
use App\UseCases\Contracts\Modulos\Producto\UpdateProductoInterface;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class UpdateProductoUseCase implements UpdateProductoInterface
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
    public function __construct(
        ProductoRepositoryInterface $productoRepository
    ) {
        $this->productoRepository = $productoRepository;
    }

    /**
     * Función para actualizar un producto
     *
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function handle(int $id, Request $request): array
    {
        $producto = $this->productoRepository->update($id, $request);

        return [
            'alert' => true,
            'icon' => 'success',
            'title' => 'Producto actualizado',
            'limpForm' => 'producto',
            'data' => [
                'id' => $producto->id,
                'tipo' => $producto->tipo,
                'precio' => $producto->precio,
            ]
        ];
    }
}
