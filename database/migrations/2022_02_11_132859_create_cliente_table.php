<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('tipo_documento');
            $table->bigInteger('numero_documento')->unique();
            $table->bigInteger('celular');
            $table->string('correo')->unique();
            $table->string('direccion');
            $table->unsignedBigInteger('asesor_id');
            $table->timestamps();

            $table->foreign('asesor_id')->references('id')->on('asesor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
