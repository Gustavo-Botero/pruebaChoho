<?php

namespace App\UseCases\Modulos\Producto;

use App\UseCases\Contracts\Modulos\Producto\DeleteProductoInterface;
use App\Repositories\Contracts\Modulos\Producto\ProductoRepositoryInterface;

class DeleteProductoUseCase implements DeleteProductoInterface
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
     * Función para eliminar un registro de la tabla producto
     *
     * @param integer $id
     * @return array
     */
    public function handle(int $id): array
    {
        $this->productoRepository->delete($id);

        return [
            'alert' => true,
            'icon' => 'info',
            'title' => 'Producto eliminado correctamente.',
            'limpForm' => 'producto'
        ];
    }
}
