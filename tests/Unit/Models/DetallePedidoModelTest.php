<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\DetallePedidoModel;

class DetallePedidoModelTest extends TestCase
{
   public function test_belongs_to_factura()
    {
        $detallePedido = DetallePedidoModel::factory()->create();
        
        $this->assertInstanceOf(FacturaModel::class, $detallePedido->factura);
    }

    public function test_belongs_to_producto()
    {
        $detallePedido = DetallePedidoModel::factory()->create();

        $this->assertInstanceOf(ProductoModel::class, $detallePedido->producto);
    }
}
