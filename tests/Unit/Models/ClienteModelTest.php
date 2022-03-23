<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\AsesorModel;
use App\Models\ClienteModel;
use Illuminate\Database\Eloquent\Collection;

class ClienteModelTest extends TestCase
{
    public function test_belongs_to_asesor()
    {
        $cliente = ClienteModel::factory()->create();

        $this->assertInstanceOf(AsesorModel::class, $cliente->asesor);
    }

    public function test_has_may_facturas()
    {
        $cliente = new ClienteModel;
        
        $this->assertInstanceOf(Collection::class, $cliente->facturas);
    }
}
