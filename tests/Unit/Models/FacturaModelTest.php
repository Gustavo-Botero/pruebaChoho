<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\ClienteModel;
use App\Models\FacturaModel;
use Illuminate\Database\Eloquent\Collection;

class FacturaModelTest extends TestCase
{
    public function test_belongs_to_cliente()
    {
        $factura = FacturaModel::factory()->create();

        $this->assertInstanceOf(ClienteModel::class, $factura->cliente);
    }

    public function test_has_many_detalle_pedidos()
    {
        $factura = new FacturaModel;

        $this->assertInstanceOf(Collection::class, $factura->detallePedidos);
    }
}
