<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AsesorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // datos a enviar
        $data = [
            'nombre' => 'Gustavo',
            'apellido' => 'Botero',
            'tipo_documento' => 'CC',
            'numero_documento' => 1110423044,
            'celular' => 3162343233,
            'correo' => 'gaboterov@gmail.com',
            'direccion' => 'Av siempre viva'
        ];

        // probando el endpoint
        $response = $this->postJson('/asesor', $data);

        // Nos aseguramos de que todo marcha bien
        $response->assertOk();

        // Revisamos que la información persista en la tabla
        $this->assertDatabaseHas('asesor', $data);

        // Comparamos si es lo que guardamos
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'Asesor guardado correctamente',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $data['numero_documento'],
                'celular' => $data['celular'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion']
            ]
        ]);
    }

    public function test_update_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Datos de prueba
        $asesor = AsesorModel::factory()->create();
        $data = [
            'nombre' => 'Gustavo',
            'apellido' => 'Botero',
            'tipo_documento' => 'CC',
            'numero_documento' => 1110423044,
            'celular' => 3162343233,
            'correo' => 'gaboterov@gmail.com',
            'direccion' => 'Av siempre viva'
        ];

        // probando el endpoint
        $response = $this->putJson('/asesor/' . $asesor->id, $data);

        // Nos aseguramos de que todo marcha bien
        $response->assertOk();

        // Revisamos que la información persista en la tabla
        $this->assertDatabaseHas('asesor', $data);

        // Comparamos que si lo haya actualizado
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'success',
            'title' => 'El asesor fue actualizado',
            'limpForm' => 'asesor',
            'data' => [
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'tipo_documento' => $data['tipo_documento'],
                'numero_documento' => $data['numero_documento'],
                'celular' => $data['celular'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion']
            ]
        ]);
    }

    public function test_destroy_asesor()
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

        // Revisamos que se haya eliminado el registro de la tabla
        $this->assertDatabaseMissing('asesor', ['id' => $asesor->id]);

        // Comparamos la respuesta
        $response->assertExactJson([
            'alert' => true,
            'icon' => 'info',
            'title' => 'El asesor fue eliminado correctamente.',
            'limpForm' => 'asesor'
        ]);
    }
}
