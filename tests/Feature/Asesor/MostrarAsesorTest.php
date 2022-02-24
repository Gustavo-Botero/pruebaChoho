<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MostrarAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_mostrar_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        
        // Creamos los registros de la tabla asesor
        $asesor = AsesorModel::factory()->create();
        
        // probamos el endpoint
        $response = $this->getJson('/asesor/' . $asesor->id);
        
        // Nos aseguramos de que todo esta bien
        $response->assertOk();

        $response->assertExactJson([
            'data' => [
                'id' => $asesor->id,
                'name' => $asesor->name,
                'apellido' => $asesor->apellido,
                'tipo_documento' => $asesor->tipo_documento,
                'numero_documento' => $asesor->numero_documento,
                'celular' => $asesor->celular,
                'correo' => $asesor->correo,
                'direccion' => $asesor->direccion
            ]
        ]);

        // Eliminando los registros y dejando el auto_increment en iniciando desde 1
        $asesor->delete();
        DB::statement("ALTER TABLE asesor AUTO_INCREMENT =  1");
    }
}
