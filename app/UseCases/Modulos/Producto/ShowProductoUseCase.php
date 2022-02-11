<?php

namespace App\UseCases\Modulos\Producto;

use App\UseCases\Contracts\Modulos\Producto\ShowProductoInterface;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class ShowProductoUseCase implements ShowProductoInterface
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
     * Función para buscar un registro por id de la tabla producto
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array
    {
        $producto = $this->productoRepository->find($id);

        return [
            'data' => [
                'id' => $producto->id,
                'tipo' => $producto->tipo,
                'precio' => $producto->precio,
            ]
        ];
    }
}
