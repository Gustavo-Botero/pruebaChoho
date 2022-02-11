<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActualizarAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_actualizar_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Datos de prueba
        $asesorMosel = new AsesorModel;
        $asesor = $asesorMosel->factory()->create();
        
        // probando el endpoint
        $response = $this->putJson('/asesor/' . $asesor->id, [
            'data' => [
                'nombre' => 'Gustavo',
                'apellido' => 'Botero',
                'tipo_documento' => 'CC',
                'numero_documento' => 1110423044,
                'celular' => 3162343233,
                'correo' => 'gaboterov@gmail.com',
                'direccion' => 'Av siempre viva'
            ]
        ]);
        
        // Nos aseguramos de que todo marcha bien
        $response->assertOk();

        // Revisamos de que tenga por lo menos un dato en la tabla asesor
        $this->assertCount(1, $asesor->all());

        // refrescamos los datos
        $asesor = $asesor->fresh();

        // Comparamos que si lo haya actualizado
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'El asesor fue actualizado',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $asesor->nombre,
                'apellido' => $asesor->apellido,
                'tipo_documento' => $asesor->tipo_documento,
                'numero_documento' => $asesor->numero_documento,
                'celular' => $asesor->cedular,
                'correo' => $asesor->correo,
                'direccion' => $asesor->direccion
            ]
        ]);
    }
}
