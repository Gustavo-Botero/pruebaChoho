<?php

namespace Tests\Feature\Asesor;

use Tests\TestCase;
use App\Models\AsesorModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListarAsesorTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Crear datos de prueba
        $asesor = new AsesorModel();
        $asesor->factory(3)->create();
        
        // Consumir la ruta
        $response = $this->getJson('/asesor');
        
        // Asegurarnos de que todo esta bien en esa ruta
        $response->assertOk();
        
        // Revisar que tengamos los registros creados
        $this->assertCount(3, $asesor->all());
        
        // Crear la vista
        $response->assertViewIs('asesor.index');
        
        // Enviar datos a la vista
        $response->assertViewHas('asesor', $asesor->all());

        // Eliminando los registros y dejando el auto_increment en iniciando desde 1
        while (count($asesor->all()->toArray()) != 0) {
            $asesor->first()->delete();
        }
        DB::statement("ALTER TABLE asesor AUTO_INCREMENT =  1");
    }
}
