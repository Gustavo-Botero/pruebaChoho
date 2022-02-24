<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EliminarAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_eliminar_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Datos de prueba
        $asesorModel = new AsesorModel;
        $asesor = $asesorModel->factory()->create();
        
        // probando el endpoint
        $response = $this->deleteJson('/asesor/' . $asesor->id);
        
        // Nos aseguramos de que todo marcha bien
        $response->assertOk();
        
        // Revisamos que se haya eliminado el registro de la tabla asesor
        $this->assertCount(0, $asesorModel->all());
        
        // Comparamos la respuesta
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'info',
            'title' => 'El asesor fue eliminado correctamente.',
            'limpForm' => 'asesor'
        ]);

        // Dejando el auto_increment en iniciando desde 1
        DB::statement("ALTER TABLE asesor AUTO_INCREMENT =  1");
    }
}
