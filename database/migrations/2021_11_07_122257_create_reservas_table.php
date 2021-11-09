<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {

            $table->id();

            $table->dateTime('fecha_compra');

            $table->dateTime('fecha_vencimiento');

            $table->double('monto');

            $table->unsignedBigInteger('cliente_fk');

            $table->foreign('cliente_fk')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('servicio_fk');

            $table->foreign('servicio_fk')->references('id')->on('servicios')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('itinerario_fk');

            $table->foreign('itinerario_fk')->references('id')->on('itinerarios')->onUpdate('cascade')->onDelete('cascade');

            $table->engine = 'InnoDB';

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
