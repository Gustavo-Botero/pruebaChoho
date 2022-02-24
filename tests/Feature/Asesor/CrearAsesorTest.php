<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrearAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();
        
        $asesor = new AsesorModel();

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
        $this->assertCount(1, $asesor->all());
        
        // Comparamos si es lo que guardamos
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'Asesor guardado correctamente',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $asesor->first()->nombre,
                'apellido' => $asesor->first()->apellido,
                'tipo_documento' => $asesor->first()->tipo_documento,
                'numero_documento' => $asesor->first()->numero_documento,
                'celular' => $asesor->first()->cedular,
                'correo' => $asesor->first()->correo,
                'direccion' => $asesor->first()->direccion
            ]
        ]);
        
        // Eliminando los registros y dejando el auto_increment en iniciando desde 1
        $asesor->first()->delete();
        DB::statement("ALTER TABLE asesor AUTO_INCREMENT =  1");
    }
}
