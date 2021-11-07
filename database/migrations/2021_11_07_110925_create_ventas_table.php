<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->double('monto');

            $table->dateTime('fecha');

            $table->unsignedBigInteger('cliente_fk');

            $table->foreign('cliente_fk')->references('id')->on('clientes');

            $table->unsignedBigInteger('servicio_fk');

            $table->foreign('servicio_fk')->references('id')->on('servicios');

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
        Schema::dropIfExists('ventas');
    }
}
