<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrearAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        
        // probando el endpoint
        $response = $this->postJson('/asesor', [
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
        
        // Revisamos de que tengamos al menos un registro en la tabla
        $asesor = AsesorModel::all();
        $this->assertCount(1, $asesor);
        
        // Comparamos si es lo que guardamos
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'Asesor guardado correctamente',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $asesor[0]->nombre,
                'apellido' => $asesor[0]->apellido,
                'tipo_documento' => $asesor[0]->tipo_documento,
                'numero_documento' => $asesor[0]->numero_documento,
                'celular' => $asesor[0]->cedular,
                'correo' => $asesor[0]->correo,
                'direccion' => $asesor[0]->direccion
            ]
        ]);
    }
}
