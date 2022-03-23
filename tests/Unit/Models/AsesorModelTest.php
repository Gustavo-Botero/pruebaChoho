<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Database\Eloquent\Collection;

class AsesorModelTest extends TestCase
{
    public function test_has_many_clientes()
    {
        $asesor = new AsesorModel();

        $this->assertInstanceOf(Collection::class, $asesor->clientes);
    }
}
