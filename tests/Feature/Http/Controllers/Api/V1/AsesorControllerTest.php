<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use Tests\TestCase;
use App\Models\AsesorModel;
use App\Models\ClienteModel;
use App\Models\FacturaModel;
use App\Models\ProductoModel;
use App\Models\DetallePedidoModel;
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
        $response = $this->postJson('api/v1/asesor', $data);

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
        $response = $this->putJson("api/v1/asesor/$asesor->id", $data);

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
        $asesor = AsesorModel::factory()->create();

        // probando el endpoint
        $response = $this->deleteJson("api/v1/asesor/$asesor->id");

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

    public function test_show_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Creamos los registros de la tabla asesor
        $asesor = AsesorModel::factory()->create();

        // probamos el endpoint
        $response = $this->getJson("api/v1/asesor/$asesor->id");

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
    }

    public function test_list_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Crear datos de prueba
        $asesor = new AsesorModel();
        $asesor->factory(3)->create();

        // Consumir la ruta
        $response = $this->getJson('api/v1/asesor');

        // Asegurarnos de que todo esta bien en esa ruta
        $response->assertOk();

        // Revisar que tengamos los registros creados
        $this->assertCount(3, $asesor->all());

        // Crear la vista
        $response->assertViewIs('asesor.index');

        // Enviar datos a la vista
        $response->assertViewHas('asesor', $asesor->all());
    }

    public function test_show_clientes_by_asesor()
    {
        // Metodo para que me muestre las excepciones
        $this->withoutExceptionHandling();

        // Creamos los registros para prueba
        $asesorModel = AsesorModel::factory()->create();
        $clienteModel = ClienteModel::factory(3)->create([
            'asesor_id' => $asesorModel->id
        ]);
        $productoModel = ProductoModel::factory(3)->create();;
        $facturaModel = FacturaModel::factory(3)->create([
            'cliente_id' => $clienteModel[0]->id
        ]);

        $detallePedidoModel = DetallePedidoModel::factory(3)->create([
            'factura_id' => $facturaModel[0]->id,
            'producto_id' => $productoModel[0]->id
        ]);

        // probamos el endpoint
        $response = $this->getJson("api/v1/asesor/cliente/$asesorModel->id");

        // Nos aseguramos de que todo esta bien
        $response->assertOk();

        $cliente = ClienteModel::with('asesor')
            ->with('facturas')
            ->with('facturas.detallePedidos')
            ->with('facturas.detallePedidos.producto')
            ->where('asesor_id', '=', $asesorModel->id)
            ->get()->toArray();

        $numClientes = 0;
        $totalPedidos = 0;
        $clientesArray = [];
        foreach ($cliente as $rowCliente) {
            $numClientes++;
            $totalPedidos += count($rowCliente['facturas']);
            $detallePedidosArray = [];
            foreach ($rowCliente['facturas'] as $facturas) {
                $productosArray = [];
                foreach ($facturas['detalle_pedidos'] as $pedidos) {

                    array_push($productosArray, [
                        'id_producto' => $pedidos['producto']['id'],
                        'tipo' => $pedidos['producto']['tipo'],
                        'cantidad' => $pedidos['cantidad'],
                        'valor_unitario' => $pedidos['producto']['precio']
                    ]);
                }

                array_push($detallePedidosArray, [
                    'id_pedido' => $facturas['id'],
                    'total_productos' => count($facturas['detalle_pedidos']),
                    'productos' => $productosArray
                ]);
            }

            array_push($clientesArray, [
                'id_cliente' => $rowCliente['id'],
                'total_pedidos' => count($rowCliente['facturas']),
                'nombre' => $rowCliente['nombre'] . ' ' . $rowCliente['apellido'],
                'detalle_pedidos' => $detallePedidosArray
            ]);
        }

        // Revisamos de que la respuesta sea lo esperado
        $response->assertExactJson([
            'data' => [
                'cod_asesor' => $asesorModel->id,
                'name' => $asesorModel->nombre  . ' ' . $asesorModel->apellido,
                'clientes_asignados' => $numClientes,
                'total_pedidos' => $totalPedidos,
                'clientes' => $clientesArray
            ]
        ]);
    }

    // validación

    public function test_validate_store_asesor()
    {
        // probando el endpoint
        $this->postJson('api/v1/asesor', [])
            ->assertJsonValidationErrors([
                'nombre',
                'apellido',
                'tipo_documento',
                'numero_documento',
                'celular',
                'correo',
                'direccion'
            ]);
    }

    public function test_validate_update_asesor()
    {
        $asesor = AsesorModel::factory()->create();
        
        // probando el endpoint
        $this->putJson("api/v1/asesor/$asesor->id", [])
            ->assertJsonValidationErrors([
                'nombre',
                'apellido',
                'tipo_documento',
                'numero_documento',
                'celular',
                'correo',
                'direccion'
            ]);
    }
}
